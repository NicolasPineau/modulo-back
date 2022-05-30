<?php

namespace App\Controller\Admin;


use App\Entity\Scope;
use App\Entity\TypeEvent;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tableau de bord - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Les évenements', 'fas fa-calendar', Event::class);
        yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Les types d\'évenement', 'fas fa-exclamation', TypeEvent::class);
        yield MenuItem::linkToCrud('Les scopes', 'fas fa-map', Scope::class);
    }
}
