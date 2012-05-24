<?php

namespace Rithis\StoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class CategoryAdmin extends Admin
{
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper->add('name');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid->add('name');
    }
}
