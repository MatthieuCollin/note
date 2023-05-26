<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use App\Repository\ControleRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteEleveController extends AbstractController
{
    #[Route('/note-eleve', name: 'app_note_eleve')]
    public function index(ControleRepository $controleRepository, UserRepository $userRepository): Response
    {
        $userId = $this->getUser();
        $user = $userRepository->findOneBy(array('id'=>$userId));

        $controles = $user->getClasse()->getcontrole();

        foreach($controles as $controle){
            foreach($controle->getNotes() as $note){
                if($note->getEleve() == $userId){
                    $dataNote = $note->getNote();
                }
            }
            $dataControle [] = [
                'name' => $controle->getName(),
                'formateur' => $controle->getFormateur()->getLastname(),
                'matiere' => $controle->getMatiere()->getName(),
                'note' => $dataNote
            ];
        }

        return $this->render('note/note_eleve/index.html.twig', [
            'controller_name' => 'NoteEleveController',
            'controles' => $dataControle
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
