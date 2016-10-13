<?php

namespace Unipik\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Unipik\InterventionBundle\Form\EtablissementType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
/**
 * Class ContactType
 * @package Unipik\UserBundle\Form
 */
class ContactType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('email')
            ->add('nom',TextType::class,array('label' => 'Nom'))
            ->add('prenom',TextType::class,array('label' => 'Prénom'))
            ->add('telFixe',TextType::class,array('label' => 'Téléphone fixe'))
            ->add('telPortable',TextType::class,array('label' => 'Téléphone portable'))
            ->add('typeContact',ChoiceType::class,array(
                'choices' => array(
                    'Enseignant' => 'enseignant',
                    'Étudiant' => 'etudiant',
                    'Animateur' => 'animateur',
                    'Élève' => 'eleve',
                    'Autre' => 'autre'
                )
            ))
            ->add('respoEtablissement',CheckBoxType::class,array('label' => 'Êtes vous le chef d\'établissement ?', 'required' => false))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Unipik\UserBundle\Entity\Contact'
        ));
    }
}
