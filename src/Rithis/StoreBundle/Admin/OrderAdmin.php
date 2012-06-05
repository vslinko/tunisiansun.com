<?php

namespace Rithis\StoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class OrderAdmin extends Admin
{
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper->add('id');
        $showMapper->add('positions');
        $showMapper->add('customer');
        $showMapper->add('price');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->add('positions');
        $listMapper->add('customer');
        $listMapper->add('price');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid->add('id');
        $datagrid->add('positions');
        $datagrid->add('customer');
    }
}
