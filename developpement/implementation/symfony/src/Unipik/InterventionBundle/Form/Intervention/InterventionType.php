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

        $choiceClasse = array('required' => false, 'mapped' => false, 'label' => 'Année scolaire', 'attr' => ['class' => 'form-annee-scolaire'],
        'choices' => [
                'Petite Section' => 'petite section',
                'Petite/Moyenne Section' => 'petite-moyenne section',
                'Moyenne Section' => 'moyenne section',
                'Moyenne/Grande Section' => 'moyenne-grande section',
                'Grande Section' => 'grande section',
                'Petite/Moyenne/Grande Section' => 'petite-moyenne-grande section',
                'CP' => 'CP',
                'CP/CE1' => 'CP-CE1',
                'CE1' => 'CE1',
                'CE1/CE2' => 'CE1-CE2',
                'CE2' => 'CE2',
                'CE2/CM1' => 'CE2-CM1',
                'CM1' => 'CM1',
                'CM1/CM2' => 'CM1-CM2',
                'CM2' => 'CM2',
                '6ème' => '6eme',
                '5ème' => '5eme',
                '4ème' => '4eme',
                '3ème' => '3eme',
                '2nde' => '2nde',
                '1ère' => '1ere',
                'Terminale' => 'terminale',
                'L1' => 'L1',
                'L2' => 'L2',
                'L3' => 'L3',
                'M1' => 'M1',
                'M2' => 'M2',
                'Autre' => 'autre'

            ]
        );

        $builder
            ->add('TypeGeneral',ChoiceType::class, $generalType)
            ->add('materiel', MaterielType::class, array('label' => 'Matériel'))
            ->add('materielFrimousse',MaterielFrimousseType::class, array('label' => 'Matériel frimousse'))
            ->add('participants', ElevesType::class, array('label' => 'Participants'))
            ->add('niveauClasse', ChoiceType::class, $choiceClasse)
            ->add('themes', ThemesType::class, array('label' => 'Choix des thèmes'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'intervention';
    }
}
