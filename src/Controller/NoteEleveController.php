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
    public function index( UserRepository $userRepository): Response
    {

        $dataControle = [];

        $userId = $this->getUser();
        $user = $userRepository->findOneBy(array('id'=>$userId));

        if($user->getRoles()[0] == "ROLE_TUTEUR"){
            $eleve = $user->getUser();
        }else{
            $eleve = $user;
        }

        $classes = $eleve->getClasse();
        if(!$classes){
            $dataControle [] = [
                'name' => 'Vous n`avez pas de classe pour le moment',
                'formateur' => '',
                'matiere' => '',
                'note' => ['']
            ];
        }else{
            $controles = $classes->getControle();
        }

        return $this->render('note/note_eleve/index.html.twig', [
            'controller_name' => 'NoteEleveController',
            'controles' => $controles
        ]);
    }

    #[Route('/note-prof', name: 'app_note_prof')]
    public function noteProf(ControleRepository $controleRepository, UserRepository $userRepository): Response
    {

        $userId = $this->getUser();
        $controles = $controleRepository->findBy(array('formateur'=>$userId));

        if(!$controles){
            $dataNote[
                ]=[
                    'note' => 'pas de notes',
                    'firstname' =>'',
                    'lastname'=>''
                ];

            $dataControle [] = [
                'name' => 'Pas de contrôle',
                'formateur' => '',
                'matiere' => '',
                'notes' => $dataNote
            ];

        }else{
            foreach($controles as $controle){
                $notes = $controle->getNotes();
                if($notes->isEmpty()){
                    $dataNote = array();
    
                    $dataNote[]=[
                        'note' => 'pas de notes',
                        'firstname' =>'',
                        'lastname'=>''
                    ];
                }else{
                    foreach($notes as $note){
                        $dataNote = array();
    
                        $dataNote [] =[
                            'note' => $note->getNote(),
                            'firstname' => $note->getEleve()->getFirstname(),
                            'lastname'=> $note->getEleve()->getLastname()
                        ];
                    }
                }
                
                $dataControle [] = [
                    'name' => $controle->getName(),
                    'formateur' => $controle->getFormateur()->getLastname(),
                    'matiere' => $controle->getMatiere()->getName(),
                    'notes' => $dataNote
                ];
            }
        }


        

        return $this->render('note/note-prof/index.html.twig', [
            'controller_name' => 'NoteEleveController',
            'controles' => $dataControle

        ]);
    }
}
