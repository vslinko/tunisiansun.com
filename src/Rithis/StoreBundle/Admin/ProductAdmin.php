<?php

namespace Rithis\StoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class ProductAdmin extends Admin
{
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('price')
            ->add('description')
            ->add('category')
            ->add('brand');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('price')
            ->add('description')
            ->add('category')
            ->add('brand');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('price')
            ->add('category')
            ->add('brand');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid
            ->add('name')
            ->add('category')
            ->add('brand');
    }
}
