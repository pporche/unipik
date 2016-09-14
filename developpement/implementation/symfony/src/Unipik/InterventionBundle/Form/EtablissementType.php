<?php

namespace Unipik\InterventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Unipik\UserBundle\Form\ContactType;
use Unipik\InterventionBundle\Form\Etablissement\TypeEnseignementType;
use Unipik\UserBundle\Form\Adresse\AdresseType;
use Unipik\InterventionBundle\Form\Etablissement\AutreEtablissementType;


class EtablissementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('uai')
            ->add('nom')
            ->add('telFixe')
            ->add('emails')
            ->add('typeEnseignement',TypeEnseignementType::class)
            ->add('typeAutreEtablissement',AutreEtablissementType::class)
            ->add('adresse',AdresseType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unipik\InterventionBundle\Entity\Etablissement'
        ));
    }
}
