<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', '📆 All posts')
            ->setEntityLabelInSingular('Post')
            ->setEntityLabelInPlural('Posts')
            ->setSearchFields(['name'])
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Post Information'),
            TextField::new('title')
                ->setLabel('📝 title')
                ->setHelp('The name of the title'),
            TextField::new('content')
                ->hideOnIndex()
                ->setLabel('📝 content')
                ->setHelp('The content of the post'),
            TextField::new('image')->hideOnIndex()
                ->setLabel('📷 image')
                ->setHelp('The image of the post'),
            AssociationField::new('user_id')
                ->setLabel('👤 nickname')
                ->setHelp('Who posted this?')
                ->setFormTypeOption('choice_label', 'nickname'),
            BooleanField::new('isPublished')
                ->setLabel('📅 Published')
                ->setHelp('Is this post published?'),
            
        ];
    }
}
