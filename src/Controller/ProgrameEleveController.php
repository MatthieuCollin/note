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

        if($user->getRoles()[0] == "ROLE_TUTEUR"){
            $eleve = $user->getUser();
        }else{
            $eleve = $user;
        }
        
        $classe = $eleve->getClasse();
        $matieres = $classe->getMatieres();

        if(!$matieres){
            $dataMatiere [] = [
                'name' => 'pas de matière',
                'programmes' => '',
                'classes' =>  '',
            ];
        }else{
            $matiere = $matieres;
        }

/*         dd($matiere[0]);
 */        
        return $this->render('programme/programe_eleve/index.html.twig', [
            'controller_name' => 'ProgrameEleveController',
            'matieres' => $matiere
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
