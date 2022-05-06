<?php

namespace App\Controller;

use App\Entity\Scope;
use App\Repository\ScopeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET', 'POST'])]
    public function home(ScopeRepository $scopeRepository): Response
    {
        $scopes = $scopeRepository->findByUser($this->getUser()->getId());
        return $this->render('home.html.twig', [
            'scopes' => $scopes,
        ]);
    }

    #[Route('/choice/{scope_id}', name: 'app_change_scope')]
    #[Entity('scope', expr: "repository.find(scope_id)")]
    public function changeScope(Scope $scope, EntityManagerInterface $entityManager)
    {
        $code = $scope->getRole()->getCode();

        $this->getUser()->setRoles(["ROLE_" . $code]);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }
}
