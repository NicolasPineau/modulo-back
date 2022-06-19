<?php

namespace App\Controller\Admin;

use App\Entity\Credential;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CredentialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Credential::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);

    }

    public function ConfigureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Habilitations à des fonctionnalités')
            ->setEntityLabelInSingular('une habilitation à une fonctionnalité')
            ->setPageTitle("index", "Habilitations à des fonctionnalités");
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            AssociationField::new('role', 'Rôle'),
            AssociationField::new('feature', 'Fonctionnalité'),
        ];
    }

}
