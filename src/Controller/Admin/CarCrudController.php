<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Voitures')
        ->setEntityLabelInSingular('Voiture')

        ->setPageTitle('index',  'Administration Garage V.Parrot');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('name'),
            yield NumberField::new('price'),
            yield NumberField::new('year'),
            yield NumberField::new('mileage'),
            yield TextField::new('color'),
            yield TextField::new('topping'),
            yield TextareaField::new('imageFile')->setFormType(VichImageType::class),
            yield AssociationField::new('equipment'),
            yield AssociationField::new('brand')
        ];
    }
    
}
