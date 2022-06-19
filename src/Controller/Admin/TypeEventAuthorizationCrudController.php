<?php

namespace App\Controller\Admin;

use App\Entity\TypeEventAuthorization;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class TypeEventAuthorizationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeEventAuthorization::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);

    }

    public function ConfigureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Habilitations à des types d\'évènements ')
            ->setEntityLabelInSingular('une habilitation à un type d\'évènement')
            ->setPageTitle("index", "Habilitations à des types d'évènement");
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            AssociationField::new('role', 'Rôle'),
            AssociationField::new('typeEvent', 'Type d\'évènement'),

        ];
    }

}
