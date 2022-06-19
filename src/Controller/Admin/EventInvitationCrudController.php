<?php

namespace App\Controller\Admin;

use App\Entity\EventInvitation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;


class EventInvitationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EventInvitation::class;
    }

    public function ConfigureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Les invitations')
            ->setEntityLabelInSingular('une invitation')
            ->setPageTitle("index", "Les invitations");
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER);


    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm()->hideOnDetail(),
            AssociationField::new('event', 'Evenement'),
            AssociationField::new('recipient', 'Invités')->setFormTypeOptionIfNotSet('by_reference', false),

        ];
    }

}
