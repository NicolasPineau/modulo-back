<?php

namespace App\Controller\Admin;

use App\Entity\AgeSection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class AgeSectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AgeSection::class;
    }

    public function ConfigureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Les section d\'âge')
            ->setEntityLabelInSingular('Section d\'Age')
            ->setPageTitle("index", "Les section d'âge");
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            TextField::new('name'),
            TextField::new('code'),
            TextField::new('color'),

        ];
    }

}
