<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrameEleveController extends AbstractController
{
    #[Route('/programme-eleve', name: 'app_programme_eleve')]
    public function index(): Response
    {
        return $this->render('programe_eleve/index.html.twig', [
            'controller_name' => 'ProgrameEleveController',
        ]);
    }

    #[Route('/programme-prof', name: 'app_programme_eleve')]
    public function programmeProf(): Response
    {
        return $this->render('programme_prof/index.html.twig', [
            'controller_name' => 'ProgrameEleveController',
        ]);
    }
}
