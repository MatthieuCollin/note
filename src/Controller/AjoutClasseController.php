<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ajout-classe')]
class AjoutClasseController extends AbstractController
{
    #[Route('/', name: 'app_ajout_classe_index', methods: ['GET'])]
    public function index(ClasseRepository $classeRepository): Response
    {
        return $this->render('ajout_classe/index.html.twig', [
            'classes' => $classeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ajout_classe_new', methods: ['GET', 'POST'])]
    public function new(Request $request,  EntityManagerInterface $entityManager,ClasseRepository $classeRepository): Response
    {
        $classe = new Classe();
        
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classeRepository->save($classe, true);

            return $this->redirectToRoute('app_ajout_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_classe/new.html.twig', [
            'classe' => $classe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_classe_show', methods: ['GET'])]
    public function show(Classe $classe): Response
    {
        return $this->render('ajout_classe/show.html.twig', [
            'classe' => $classe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ajout_classe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Classe $classe, ClasseRepository $classeRepository, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classeRepository->save($classe, true);

            return $this->redirectToRoute('app_ajout_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_classe/edit.html.twig', [
            'classe' => $classe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_classe_delete', methods: ['POST'])]
    public function delete(Request $request, Classe $classe, ClasseRepository $classeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classe->getId(), $request->request->get('_token'))) {
            $classeRepository->remove($classe, true);
        }

        return $this->redirectToRoute('app_ajout_classe_index', [], Response::HTTP_SEE_OTHER);
    }
}
