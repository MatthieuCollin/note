<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrameEleveController extends AbstractController
{
    #[Route('/programe/eleve/{{id}}', name: 'app_programe_eleve')]
    public function index(): Response
    {
        return $this->render('programe_eleve/index.html.twig', [
            'controller_name' => 'ProgrameEleveController',
        ]);
    }
}
