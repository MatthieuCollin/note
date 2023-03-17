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
        return $this->render('note_eleve/index.html.twig', [
            'controller_name' => 'NoteEleveController',
        ]);
    }

    #[Route('/note-prof', name: 'app_note_prof')]
    public function noteProf(): Response
    {
        return $this->render('note_prof/index.html.twig', [
            'controller_name' => 'NoteEleveController',
        ]);
    }
}
