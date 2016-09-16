<?php

namespace Unipik\InterventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Unipik\InterventionBundle\Form\Etablissement\TypeCentreType;
use Unipik\UserBundle\Form\ContactType;
use Unipik\InterventionBundle\Form\Etablissement\TypeEnseignementType;
use Unipik\UserBundle\Form\Adresse\AdresseType;
use Unipik\InterventionBundle\Form\Etablissement\AutreEtablissementType;


class EtablissementType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $educationChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false,
            'choices' => [
                'Maternelle' => 'maternelle',
                'Elementaire' => 'elementaire',
                'Collège' => 'college',
                'Lycée' => 'lycee',
                'Supérieur' => 'superieur'
            ],);

        $centerChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false,
            'choices' => [
                'Maternelle' => 'maternelle',
                'Elementaire' => 'elementaire',
                'Adolescent' => 'adolescent',
                'Autre' => 'autre',
            ],);

        $otherChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false,
            'choices' => [
                'Mairie' => 'mairie',
                'Maison de retraite' => 'maison de retraite',
                'Autre' => 'autre'
            ],);

        $builder
            ->add('uai')
            ->add('nom')
            ->add('telFixe')
            ->add('emails')
            ->add('typeEnseignement',ChoiceType::class, $educationChoiceType)
            ->add('typeAutreEtablissement',ChoiceType::class, $otherChoiceType)
            ->add('typeCentre', ChoiceType::class, $centerChoiceType)
            ->add('adresse',AdresseType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Unipik\InterventionBundle\Entity\Etablissement'
        ));
    }
}