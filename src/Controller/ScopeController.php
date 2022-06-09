<?php

namespace App\Controller;

use App\Entity\AgeSection;
use App\Entity\Role;
use App\Entity\Scope;
use App\Entity\Structure;
use App\Entity\User;
use App\Form\ScopeType;
use App\Repository\ScopeRepository;
use App\Repository\StructureRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/scope')]
class ScopeController extends AbstractController
{
    #[Route('/', name: 'app_scope_index', methods: ['GET'])]
    public function index(ScopeRepository $scopeRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $scopes = $scopeRepository->findAll();

        $scopes = $paginator->paginate(
            $scopes,
            $request->query->getInt('page',1),20

        );

        return $this->render('scope/index.html.twig', [
            'scopes' => $scopes,
        ]);
    }

    #[Route('/new', name: 'app_scope_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, StructureRepository $structureRepository): Response
    {
        $scope = new Scope(new User('','','','',''),
            new Structure('','',$structureRepository->find(['id'=> 1])),
            new Role('','',new AgeSection('','',''),''));
        $form = $this->createForm(ScopeType::class, $scope);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $scope->setUser($form->get('user')->getData());
            $scope->setRole($form->get('role')->getData());
            $scope->setStructure($form->get('structure')->getData());
            $entityManager->persist($scope);
            $entityManager->flush();
            $this->addFlash('success scope','Votre scope a bien été crée');


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
        $form = $this->createForm(ScopeType::class, $scope,['mapped'=> true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success scope','Votre scope a bien été modifié');
            $entityManager->flush();

            return $this->redirectToRoute('app_scope_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('scope/edit.html.twig', [
            'scope' => $scope,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_scope_delete', methods: ['POST'])]
    public function delete(Request $request, Scope $scope, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$scope->getId(), $request->request->get('_token'))) {

            $entityManager->remove($scope);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_scope_index', [], Response::HTTP_SEE_OTHER);
    }
}
