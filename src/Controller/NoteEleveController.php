<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteEleveController extends AbstractController
{
    #[Route('/note-eleve', name: 'app_note_eleve')]
    public function index(): Response
    {
        return $this->render('note/note_eleve/index.html.twig', [
            'controller_name' => 'NoteEleveController',
        ]);
    }

    #[Route('/ajout-note-prof', name: 'app_ajout_note_prof')]
    public function ajoutNoteProf(): Response
    {
        return $this->render('note/ajout_note_prof/index.html.twig', [
            'controller_name' => 'NoteEleveController',
        ]);
    }

    #[Route('/note-prof', name: 'app_note_prof')]
    public function noteProf(): Response
    {
        return $this->render('note/note_prof/index.html.twig', [
            'controller_name' => 'NoteEleveController',
        ]);
    }
}
