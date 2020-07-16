<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\CommentType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('body'),
//            CollectionField::new()
         CollectionField::new('comments')
             ->allowAdd()
             ->allowDelete()
             ->setEntryIsComplex(true)
             ->setEntryType(CommentType::class)
             ->setFormTypeOptions(['by_reference' => false]),


        ];
    }

}
