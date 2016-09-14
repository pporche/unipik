<?php

namespace Unipik\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Unipik\InterventionBundle\Form\EtablissementType;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('telFixe')
            ->add('telPortable')
            ->add('typeContact')
            ->add('respoEtablissement',CheckBoxType::class,array('label' => 'Êtes vous le chef d\'établissement ?', 'required' => 'true'))
            ->add('typeActivite')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unipik\UserBundle\Entity\Contact'
        ));
    }
}
