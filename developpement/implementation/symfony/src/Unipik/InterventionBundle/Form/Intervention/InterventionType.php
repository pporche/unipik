<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 14:34
 */

namespace Unipik\InterventionBundle\Form\Intervention;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;
use Unipik\InterventionBundle\Form\Intervention\MaterielFrimousseType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InterventionType extends AbstractFieldsetType {


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){

        $generalType = array('required' => true, 'mapped' => false,
            'label' => 'Type d\'Intervention',
            'choices' => [
                'Plaidoyer' => 'pld',
                'Frimousse' => 'frim',
                'Autre' => 'aut'
            ],);

        $builder
            ->add('TypeGeneral',ChoiceType::class, $generalType)
            ->add('materiel', MaterielType::class)
            ->add('materielFrimousse',MaterielFrimousseType::class)
            ->add('eleves', ElevesType::class, array('label' => 'Élèves'))
            ->add('themes', ThemesType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'intervention';
    }
}
