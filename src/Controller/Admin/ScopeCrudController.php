<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use App\Entity\Structure;
use App\Entity\Scope;
use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\StructureRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;


class ScopeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Scope::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);

    }

    public function ConfigureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Scopes')
            ->setEntityLabelInSingular('un scope')
            ->setPageTitle("index", "Les scopes");
    }

    public function createEntity(string $entityFqcn)
    {
        $scope = new Scope();
        $scope->setCreatedAt(new \DateTime('now', new \DateTimeZone('Europe/Paris')));

        return $scope;
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            yield AssociationField::new('user', 'Utilisateur')->setCrudController(UserCrudController::class),
            yield AssociationField::new('structure', 'Structure')->setCrudController(StructureCrudController::class),
            yield AssociationField::new('role', 'Rôle')->setCrudController(RoleCrudController::class),
            yield BooleanField::new('active', 'Activé / Désactivé'),
            yield DateTimeField::new('createdAt', 'Crée le ')->setTimezone('Europe/Paris')->hideOnForm()
        ];
    }

}
