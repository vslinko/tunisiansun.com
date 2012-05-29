<?php

namespace Rithis\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PositionType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('product', new ProductType());
        $builder->add('count', 'integer');
    }

    public function getName()
    {
        return 'position';
    }
}
