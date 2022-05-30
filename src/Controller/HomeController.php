<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(EventRepository $eventRepository)
    {
        return $this->render('home.html.twig', [
            'events' => $eventRepository->findActiveProject(),
        ]);
    }
}
