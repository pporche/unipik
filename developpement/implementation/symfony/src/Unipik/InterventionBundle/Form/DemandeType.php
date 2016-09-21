<?php

namespace Unipik\InterventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Unipik\UserBundle\Form\ContactType;
use Unipik\InterventionBundle\Form\EtablissementType;
use Unipik\InterventionBundle\Form\Intervention\InterventionType;

class DemandeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Etablissement', EtablissementType::class,array('mapped' => false,'label' => 'Informations de l\'établissement'))
            ->add('Intervention',InterventionType::class,array('mapped' => false, 'label' => 'Information sur l\'intervention'))
            ->add('Contact',ContactType::class,array('label' => 'Information sur le contact'))
            ->add('Valider la demande',SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
      /*$resolver->setDefaults(array(
            'data_class' => 'Unipik\InterventionBundle\Entity\Demande'
        )); */
    }
}
