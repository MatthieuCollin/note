<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Form\ProgrammeType;
use App\Repository\ProgrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ajout-programme')]
class AjoutProgrammeController extends AbstractController
{
    #[Route('/', name: 'app_ajout_programme_index', methods: ['GET'])]
    public function index(ProgrammeRepository $programmeRepository): Response
    {
        $programmes = $programmeRepository->findAll();
        $data = [];
        foreach($programmes as $programme){
            $data [] =[
                'name' => $programme->getName(),
                'classe' => $programme->getMatiere()->getName(),
                'id' => $programme->getId()
            ];
        }

        return $this->render('ajout_programme/index.html.twig', [
            'programmes' => $data,
        ]);
    }

    #[Route('/new', name: 'app_ajout_programme_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProgrammeRepository $programmeRepository): Response
    {
        $programme = new Programme();
        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programmeRepository->save($programme, true);

            return $this->redirectToRoute('app_ajout_programme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_programme/new.html.twig', [
            'programme' => $programme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_programme_show', methods: ['GET'])]
    public function show(Programme $programme): Response
    {
        return $this->render('ajout_programme/show.html.twig', [
            'programme' => $programme,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ajout_programme_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Programme $programme, ProgrammeRepository $programmeRepository): Response
    {
        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programmeRepository->save($programme, true);

            return $this->redirectToRoute('app_ajout_programme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_programme/edit.html.twig', [
            'programme' => $programme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_programme_delete', methods: ['POST'])]
    public function delete(Request $request, Programme $programme, ProgrammeRepository $programmeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$programme->getId(), $request->request->get('_token'))) {
            $programmeRepository->remove($programme, true);
        }

        return $this->redirectToRoute('app_ajout_programme_index', [], Response::HTTP_SEE_OTHER);
    }
}
