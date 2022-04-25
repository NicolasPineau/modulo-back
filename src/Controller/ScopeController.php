<?php

namespace App\Controller;

use App\Entity\Scope;
use App\Form\ScopeType;
use App\Repository\ScopeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/scope')]
class ScopeController extends AbstractController
{
    #[Route('/', name: 'app_scope_index', methods: ['GET'])]
    public function index(ScopeRepository $scopeRepository): Response
    {
        return $this->render('scope/index.html.twig', [
            'scopes' => $scopeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_scope_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $scope = new Scope();
        $form = $this->createForm(ScopeType::class, $scope);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($scope);
            $entityManager->flush();

            return $this->redirectToRoute('app_scope_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('scope/new.html.twig', [
            'scope' => $scope,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_scope_show', methods: ['GET'])]
    public function show(Scope $scope): Response
    {
        return $this->render('scope/show.html.twig', [
            'scope' => $scope,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_scope_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Scope $scope, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ScopeType::class, $scope);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_scope_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('scope/edit.html.twig', [
            'scope' => $scope,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_scope_delete', methods: ['POST'])]
    public function delete(Request $request, Scope $scope, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$scope->getId(), $request->request->get('_token'))) {
            $entityManager->remove($scope);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_scope_index', [], Response::HTTP_SEE_OTHER);
    }
}
