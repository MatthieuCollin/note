<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use App\Repository\ControleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteEleveController extends AbstractController
{
    #[Route('/note-eleve', name: 'app_note_eleve')]
    public function index(ControleRepository $controleRepository, ClasseRepository $classeRepository): Response
    {
        $idEleve = $this->getUser();
        $classes = $classeRepository->findBy(array('user_id'=> $idEleve->getId()));

        dd($classes);

        $controles = $controleRepository->findBy(array('classe' => $classes[0]));

        return $this->render('note/note_eleve/index.html.twig', [
            'controller_name' => 'NoteEleveController',
        ]);
    }

    #[Route('/note-prof', name: 'app_note_prof')]
    public function noteProf(): Response
    {
        return $this->render('note/note-prof/index.html.twig', [
            'controller_name' => 'NoteEleveController',
        ]);
    }
}
