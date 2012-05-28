<?php

namespace Rithis\StoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class CustomerAdmin extends Admin
{
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper->add('id');
        $showMapper->add('email');
        $showMapper->add('phone');
        $showMapper->add('name');
        $showMapper->add('admin');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('email');
        $formMapper->add('phone');
        $formMapper->add('name');
        $formMapper->add('admin');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('email');
        $listMapper->add('phone');
        $listMapper->add('name');
        $listMapper->add('admin');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid->add('email');
        $datagrid->add('phone');
        $datagrid->add('name');
        $datagrid->add('admin');
    }
}
