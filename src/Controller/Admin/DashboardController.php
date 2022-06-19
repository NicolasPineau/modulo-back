<?php

namespace App\Controller\Admin;


use App\Entity\AgeSection;
use App\Entity\Credential;
use App\Entity\EventInvitation;
use App\Entity\Feature;
use App\Entity\Scope;
use App\Entity\TypeEvent;
use App\Entity\TypeEventAuthorization;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Entity\Role;
use App\Entity\Structure;


class DashboardController extends AbstractDashboardController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

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
        yield MenuItem::linkToCrud('Les fonctionnalités', 'fas fa-key', Feature::class);
        yield MenuItem::linkToCrud('Les invitations', 'fas fa-flag', EventInvitation::class);
        yield MenuItem::linkToCrud('Les rôles', 'fas fa-tools', Role::class);
        yield MenuItem::linkToCrud('Les scopes', 'fas fa-map', Scope::class);
        yield MenuItem::linkToCrud('Les structures', 'fas fa-building', Structure::class);
        yield MenuItem::linkToCrud('Les types d\'évenement', 'fas fa-exclamation', TypeEvent::class);
        yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::subMenu('Les habilitations', 'fa fa-tools')->setSubItems([
            MenuItem::linkToCrud('Habilitations à des fonctionnalités', 'fa fa-tools', Credential::class),
            MenuItem::linkToCrud('Habilitations à des types d\'évènement', 'fa fa-tools', TypeEventAuthorization::class),
        ]);

    }
}
