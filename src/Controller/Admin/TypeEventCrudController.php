<?php

namespace App\Controller\Admin;

use App\Entity\TypeEvent;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class TypeEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeEvent::class;
    }

    public function ConfigureCrud(Crud $crud):Crud
    {
        return $crud
            ->setEntityLabelInPlural('Les types d\'évènements')
            ->setEntityLabelInSingular('Type d\'évènement')
            ->setPageTitle("index", "Les types d\'évènements");
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            TextField::new('name'),
        ];
    }

}
