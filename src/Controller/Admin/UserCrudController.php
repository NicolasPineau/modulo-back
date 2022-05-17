<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function ConfigureCrud(Crud $crud):Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur')
            ->setPageTitle("index", "Les utilisateurs");
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX,Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER);


    }


    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('uuid'),
            TextField::new('email'),
            TextField::new('password')->hideOnIndex()->hideOnDetail(),
            TextField::new('firstName','Prénom'),
            TextField::new('lastName','Nom'),
            TextField::new('genre')
        ];
    }

    private function setPermission(string $DELETE, string $string)
    {
    }

}
