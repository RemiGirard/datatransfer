<?php

namespace datatransfer\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddREDType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idresmin', 'text')
            ->add('idresmax', 'text')
            ->add('bits', 'text')
            ->add('idformatstart', 'text')
            ->add('camera', 'text')
            ->add('bitratemaxcam', 'text')
            ->add('media1', 'text')
            ->add('media2', 'text', array('required' => false))
            ->add('media3', 'text', array('required' => false))
            ->add('media4', 'text', array('required' => false))
            ->add('media5', 'text', array('required' => false))
            ->add('sourceinfo', 'textarea');
    }

    public function getName()
    {
        return 'title';
    }
}
