<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Role::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);

    }

    public function ConfigureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Roles')
            ->setEntityLabelInSingular('un rôle')
            ->setPageTitle("index", "Les rôles");
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->hideOnIndex()->hideOnForm()->hideonDetail(),
            yield TextField::new('name', 'Nom'),
            yield TextField::new('code', 'Code'),
            yield TextField::new('feminineName', 'Nom féminin'),
        ];
    }

}
