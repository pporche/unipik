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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Unipik\InterventionBundle\Form\Intervention\PlageDateType;
use Unipik\InterventionBundle\Form\Intervention\JourInterventionType;
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
            ->add('plageDate', PlageDateType::class, array('label' => 'Plage de dates', 'mapped' => false))
            ->add('jour', JourInterventionType::class, array('label' => "Jour d'intervention", 'mapped' => false))
            ->add('Intervention',CollectionType::class,array('entry_type' =>InterventionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'mapped' => false
                ))
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
