<?php

namespace Rithis\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('positions', 'collection', array(
            'type' => new PositionType(),
            'allow_delete' => true,
        ));
    }

    public function getName()
    {
        return 'order';
    }
}
