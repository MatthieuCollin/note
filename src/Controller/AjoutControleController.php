<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NotesType;
use App\Entity\Controle;
use App\Entity\User;
use App\Form\ControleType;
use App\Repository\ControleRepository;
use App\Repository\NoteRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ajout-controle')]
class AjoutControleController extends AbstractController
{
    #[Route('/', name: 'app_ajout_controle_index', methods: ['GET'])]
    public function index(ControleRepository $controleRepository, UserRepository $userRepository): Response
    {
        $userId = $this->getUser();
        $user = $userRepository->findOneBy(array('id'=>$userId));

        return $this->render('ajout_controle/index.html.twig', [
            'controles' => $user->getControle(),
        ]);
    }

    #[Route('/new', name: 'app_ajout_controle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ControleRepository $controleRepository, UserRepository $userRepository): Response
    {
        $controle = new Controle();
        $form = $this->createForm(ControleType::class, $controle);
        $form->handleRequest($request);

        $userId = $this->getUser();
        $user = $userRepository->findOneBy(array('id'=>$userId));

        if ($form->isSubmitted() && $form->isValid()) {
            $controle->setFormateur($user);
            $controleRepository->save($controle, true);

            return $this->redirectToRoute('app_ajout_controle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_controle/new.html.twig', [
            'controle' => $controle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_controle_show', methods: ['GET'])]
    public function show(Controle $controle, NoteRepository $noteRepository): Response
    {

        $notes = $noteRepository->findBy(array('controle' => $controle->getId()));

        foreach($notes as $note){
            $data [] =[
                'firstname' => $note->getEleve()->getFirstname(),
                'lastname' => $note->getEleve()->getLastname(),
                'note' => $note->getNote()
            ];
        }

        return $this->render('ajout_controle/show.html.twig', [
            'controle' => $controle,
            'notes' =>$data
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ajout_controle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Controle $controle, ControleRepository $controleRepository): Response
    {
        $form = $this->createForm(ControleType::class, $controle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $controleRepository->save($controle, true);

            return $this->redirectToRoute('app_ajout_controle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_controle/edit.html.twig', [
            'controle' => $controle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/notes', name: 'app_ajout_controle_edit', methods: ['GET', 'POST'])]
    public function notes(Request $request, Controle $controle, ManagerRegistry $doctrine,  EntityManagerInterface $entityManagerInterface): Response
    {


        $userrepo = $entityManagerInterface->getRepository(User::class);
        $users = $userrepo->findOneBy(array('classe'=>$controle->getClasse()->getId()));


        $note = new Note();


        $form = $this->createForm(NotesType::class, $note, [
            'classe_id' => $controle->getClasse()->getId(),
        ]);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note->setControle($controle);
            /* It's hashing the password. */

            /* It's saving the data to the database. */

            //
            $entityManager = $doctrine->getManager();
            $entityManager->persist($note);
            $entityManager->flush();


            return $this->redirectToRoute('app_ajout_controle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_controle/edit.html.twig', [
            'form' => $form,
            'controle' => $controle
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_controle_delete', methods: ['POST'])]
    public function delete(Request $request, Controle $controle, ControleRepository $controleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$controle->getId(), $request->request->get('_token'))) {
            $controleRepository->remove($controle, true);
        }

        return $this->redirectToRoute('app_ajout_controle_index', [], Response::HTTP_SEE_OTHER);
    }
}
