<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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


    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('uuid'),
            TextField::new('email'),
            TextField::new('password')->hideOnIndex(),
            TextField::new('firstName','Prénom'),
            TextField::new('lastName','Nom'),
            TextField::new('genre')
        ];
    }

}
