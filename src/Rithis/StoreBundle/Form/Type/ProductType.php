<?php

namespace Rithis\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden');
    }

    public function getName()
    {
        return 'product';
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Rithis\StoreBundle\Entity\Product',
        );
    }
}
