<?php

namespace Unipik\ArchitectureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterventionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('materielDispo', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('remarques', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('lieu', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('nbPersonnes', 'Symfony\Component\Form\Extension\Core\Type\IntegerType')
            ->add('moment', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unipik\ArchitectureBundle\Entity\Intervention'
        ));
    }
}
