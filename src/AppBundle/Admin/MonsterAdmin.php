<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class MonsterAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('level')
            ->add('health')
            ->add('mana')
            ->add('damage')
            ->add('deviation')
            ->add('defense')
            ->add('skill')
            ->add('monsterClass')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('level')
            ->add('monsterClass')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('level')
            ->add('health')
            ->add('mana')
            ->add('damage')
            ->add('deviation')
            ->add('defense')
            ->add('skill')
            ->add('monsterClass')
            ->add('baseExperience')
            ->add('ratio', null, array(
                'template'   => "AppBundle:CRUD:ratio.html.twig",
            ))
        ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('level')
            ->add('health')
            ->add('mana')
            ->add('damage')
            ->add('deviation')
            ->add('defense')
            ->add('skill')
            ->add('monsterClass')
        ;
    }
}
