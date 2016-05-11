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

class InterventionType extends AbstractFieldsetType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('plageDate', PlageDateType::class, array('label' => 'Plage de dates'))
            ->add('jour', JourInterventionType::class, array('label' => "Jour d'intervention"))
            ->add('materiel', MaterielType::class)
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

    public function getName() {
        return $this->getBlockPrefix();
    }
}