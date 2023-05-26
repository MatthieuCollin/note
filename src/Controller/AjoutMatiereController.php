<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ajout/matiere')]
class AjoutMatiereController extends AbstractController
{
    #[Route('/', name: 'app_ajout_matiere_index', methods: ['GET'])]
    public function index(MatiereRepository $matiereRepository): Response
    {
        return $this->render('ajout_matiere/index.html.twig', [
            'matieres' => $matiereRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ajout_matiere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MatiereRepository $matiereRepository): Response
    {
        $matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->get('formateur')->getData();

            foreach($data as $user){
    
                $user->setMatiere($matiere);
            }
    
            $matiereRepository->save($matiere, true);

            return $this->redirectToRoute('app_ajout_matiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_matiere/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_matiere_show', methods: ['GET'])]
    public function show(Matiere $matiere,UserRepository $userRepository, $id): Response
    {
        $users = $userRepository->findBy(array('matiere'=>$id));


        return $this->render('ajout_matiere/show.html.twig', [
            'matiere' => $matiere,
            'formateurs'=> $users,
            'classes' => $matiere->getClasse()
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ajout_matiere_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Matiere $matiere, MatiereRepository $matiereRepository): Response
    {
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->get('formateur')->getData();

            foreach($data as $user){
    
                $user->setMatiere($matiere);
            }
            
            $matiereRepository->save($matiere, true);

            return $this->redirectToRoute('app_ajout_matiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_matiere/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_matiere_delete', methods: ['POST'])]
    public function delete(Request $request, Matiere $matiere, MatiereRepository $matiereRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matiere->getId(), $request->request->get('_token'))) {
            $matiereRepository->remove($matiere, true);
        }

        return $this->redirectToRoute('app_ajout_matiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
