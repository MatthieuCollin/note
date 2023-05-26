<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\ModifyUserType;
use App\Form\ModifyPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users
        ]);
    }

    #[Route('/admin-ajout', name: 'app_admin_ajout')]
    public function modifUser(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine, UserPasswordHasherInterface $encoder): Response
    {

        // on génere une nouvelle class User
        $user = new User();

        // on génere un form a partir de cette classe
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $userRepository = $entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        // si le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // on récup les données du form
            $user = $form->getData();
            /* It's hashing the password. */
            // mot de passe de base Azerty14!
            $password = $encoder->hashPassword($user, 'Azerty14!');
            $user->setPassword($password);
            /* It's saving the data to the database. */

            //
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/modification/index.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form,
            'users' => $users
        ]);
    }

    #[Route('/password/{id}', name: 'app_modifyAdmin')]
    public function adminModify(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine, UserPasswordHasherInterface $encoder, $id): Response
    {

        $userId = $this->getUser();


        // si tu n'es pas l'user en question tu pine ta mere
        if($userId->getId() != $id ){
            return $this->redirectToRoute('app_home');
        }
        
        // on récupère l'user du parametre
        $repository = $doctrine->getRepository(User::class);
        $user = $repository->findOneBy(array('id'=>$id));

        // on génere un form
        $form = $this->createForm(ModifyPasswordType::class, $user);

        $form->handleRequest($request);

        // si le form est valide
        if ($form->isSubmitted() && $form->isValid()) {

            // on récupère les données du form
            $dataForm = $form->getData();
            $dataPW= $dataForm->getPassword();
            // on hash le mot de passe
            $password = $encoder->hashPassword($user, $dataPW);
            // on applique le mot de passe a l'user
            $user->setPassword($password);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_home');
        }


        return $this->render('admin/modification/index.html.twig', [
            'form' => $form->createView(),
            'data' => $user
        ]);
    }
}
