<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrameEleveController extends AbstractController
{
    #[Route('/programme-eleve', name: 'app_programme_eleve')]
    public function index(UserRepository $userRepository): Response
    {
        $userId = $this->getUser();
        $user = $userRepository->findOneBy(array('id'=>$userId));

        $classes = $user->getClasse();


        if(!$user->getUser()) {
            $classes = $user->getClasse();
            if(!$classes){
                $dataMatiere [] = [
                    'name' => 'Vous n`avez pas de classe pour le moment',
                    'programmes' => '',
                    'formateurFirstname' =>  '',
                    'formateurLastname' => ''
                ];
            }else{
                $matieres = $classes->getMatieres();
    
                if($matieres->isEmpty()){
                    $dataMatiere [] = [
                        'name' => 'Pas de matière pour le moment',
                        'programmes' => '',
                        'formateurFirstname' =>  '',
                        'formateurLastname' => ''
                    ];
                }else{
                    foreach($matieres as $matiere){
        
                        $matiereId = $matiere->getId();
            
                        $prof = $userRepository->findOneBy(array('matiere'=>$matiereId));
            
                        foreach($matiere->getProgrammes() as $programme){
                            $dataProgramme = array();
            
                            $dataProgramme[] =[
                                'name' => $programme->getName(),
                            ];
                        }
            
                        $dataMatiere [] = [
                            'name' => $matiere->getName(),
                            'programmes' => $dataProgramme,
                            'formateurFirstname' =>  $prof->getFirstname(),
                            'formateurLastname' => $prof->getLastname()
                        ];
                    }
                }
            }
        }else{
            $classes = $user->getUser()->getClasse();
            if(!$classes){
                $dataMatiere [] = [
                    'name' => 'Vous n`avez pas de classe pour le moment',
                    'programmes' => '',
                    'formateurFirstname' =>  '',
                    'formateurLastname' => '',
                    'eleveFirstname' => $user->getUser()->getFirstname(),
                    'eleveLastname' => $user->getUser()->getLastname()
                ];
            }else{
                $matieres = $classes->getMatieres();
    
                if($matieres->isEmpty()){
                    $dataMatiere [] = [
                        'name' => 'Pas de matière pour le moment',
                        'programmes' => '',
                        'formateurFirstname' =>  '',
                        'formateurLastname' => '',
                        'eleveFirstname' => $user->getUser()->getFirstname(),
                        'eleveLastname' => $user->getUser()->getLastname()
                    ];
                }else{
                    foreach($matieres as $matiere){
        
                        $matiereId = $matiere->getId();
            
                        $prof = $userRepository->findOneBy(array('matiere'=>$matiereId));
            
                        foreach($matiere->getProgrammes() as $programme){
                            $dataProgramme = array();
            
                            $dataProgramme[] =[
                                'name' => $programme->getName(),
                            ];
                        }
            
                        $dataMatiere [] = [
                            'name' => $matiere->getName(),
                            'programmes' => $dataProgramme,
                            'formateurFirstname' =>  $prof->getFirstname(),
                            'formateurLastname' => $prof->getLastname(),
                            'eleveFirstname' => $user->getUser()->getFirstname(),
                            'eleveLastname' => $user->getUser()->getLastname()
                        ];
                    }
                }
            }
        }
        

        return $this->render('programme/programe_eleve/index.html.twig', [
            'controller_name' => 'ProgrameEleveController',
            'matieres' => $dataMatiere
        ]);
    }

    #[Route('/programme-prof', name: 'app_programme_prof')]
    public function programmeProf(UserRepository $userRepository): Response
    {

        $userId = $this->getUser();
        $user = $userRepository->findOneBy(array('id'=>$userId));
        
        $matiere = $user->getMatiere();

        if(!$matiere){
            $dataMatiere [] = [
                'name' => 'pas de matière',
                'programmes' => '',
                'classes' =>  '',
            ];
        }else{
            $classes = $matiere->getClasse();

            foreach($classes as $classe){
                $dataClasses [] =[
                    'classname' => $classe->getName()
                ];
            }
    
            $programmes = $matiere->getProgrammes();
            if($programmes->isEmpty()){
                $dataProgramme = array();
        
                    
                $dataProgramme[] =[
                    'name' => 'pas de cours',
                ];
            }else{
                foreach( $programmes as $programme){
                    $dataProgramme = array();
        
                    
                    $dataProgramme[] =[
                        'name' => $programme->getName(),
                    ];
                }
            }
            
    
            $dataMatiere [] = [
                'name' => $matiere->getName(),
                'programmes' => $dataProgramme,
                'classes' =>  $dataClasses,
            ];
    
        }

        return $this->render('programme/programme_prof/index.html.twig', [
            'controller_name' => 'ProgrameEleveController',
            'matieres' => $dataMatiere

        ]);
    }
}
