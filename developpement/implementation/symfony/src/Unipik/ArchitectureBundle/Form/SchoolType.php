<?php

namespace Unipik\ArchitectureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchoolType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('nbEleve', 'Symfony\Component\Form\Extension\Core\Type\IntegerType')
            ->add('chefEtablissement', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('ville', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unipik\ArchitectureBundle\Entity\School'
        ));
    }
}
