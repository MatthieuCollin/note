<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\Classe;
use App\Form\NotesType;
use App\Entity\Controle;
use App\Form\ControleType;
use App\Repository\ControleRepository;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ajout/controlle')]
class AjoutControlleController extends AbstractController
{
    #[Route('/', name: 'app_ajout_controlle_index', methods: ['GET'])]
    public function index(ControleRepository $controleRepository): Response
    {
        return $this->render('ajout_controlle/index.html.twig', [
            'controles' => $controleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ajout_controlle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ControleRepository $controleRepository): Response
    {
        $controle = new Controle();
        $form = $this->createForm(ControleType::class, $controle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $controleRepository->save($controle, true);

            return $this->redirectToRoute('app_ajout_controlle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_controlle/new.html.twig', [
            'controle' => $controle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_controlle_show', methods: ['GET'])]
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

        return $this->render('ajout_controlle/show.html.twig', [
            'controle' => $controle,
            'notes' =>$data
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ajout_controlle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Controle $controle, ControleRepository $controleRepository): Response
    {
        $form = $this->createForm(ControleType::class, $controle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $controleRepository->save($controle, true);

            return $this->redirectToRoute('app_ajout_controlle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_controlle/edit.html.twig', [
            'controle' => $controle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/notes', name: 'app_ajout_controlle_edit', methods: ['GET', 'POST'])]
    public function notes(Request $request, Controle $controle, ManagerRegistry $doctrine,  EntityManagerInterface $entityManagerInterface): Response
    {


        $classerepo = $entityManagerInterface->getRepository(Classe::class);
        $classes = $classerepo->findOneBy(array('id'=>$controle->getClasse()->getId()));

        $users = $classes->getEleve();
        $note = new Note();


        $form = $this->createForm(NotesType::class, $note, [
            'users' => $users,
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


            return $this->redirectToRoute('app_ajout_controlle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_controlle/edit.html.twig', [
            'form' => $form,
            'controle' => $controle
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_controlle_delete', methods: ['POST'])]
    public function delete(Request $request, Controle $controle, ControleRepository $controleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$controle->getId(), $request->request->get('_token'))) {
            $controleRepository->remove($controle, true);
        }

        return $this->redirectToRoute('app_ajout_controlle_index', [], Response::HTTP_SEE_OTHER);
    }
}
