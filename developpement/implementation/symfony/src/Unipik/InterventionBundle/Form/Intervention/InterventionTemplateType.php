<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 14:34
 */

namespace Unipik\InterventionBundle\Form\Intervention;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;
use Unipik\InterventionBundle\Form\Intervention\MaterielFrimousseType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Unipik\ArchitectureBundle\Form\NiveauThemeType;

class InterventionTemplateType extends AbstractFieldsetType {


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * form builder
     */
    public function buildForm(FormBuilderInterface $builder, array $options){

        $generalType = array('required' => true,
            'label' => 'Type d\'Intervention*',
            'attr' => ['class' => 'form-type-intervention'],
            'choices' => [
                'Action éducative' => 'pld',
                'Frimousse' => 'frim',
                'Autre' => 'aut'
            ],);

        $builder
            ->add('TypeGeneral',ChoiceType::class, $generalType)
            ->add('materielDispoPlaidoyer', MaterielType::class, array('label' => 'Matériel*', 'required' => false))
            ->add('materiauxFrimousse',MaterielFrimousseType::class, array('label' => 'Matériel frimousse*', 'required' => false))
            ->add('nbPersonne', IntegerType::class, array('label' => 'Nb de participants*'))
            ->add('niveauTheme', NiveauThemeType::class, array('label' => false))
            ->add('remarques', TextareaType::class, array('label' => 'Remarques', 'attr'=> ['class' => 'form-remarques', 'rows' => '5', 'maxlength' => '500'], 'required' => false))
        ;
    }

    /**
     * {@inheritdoc}
     * renvoie intervention
     */
    public function getBlockPrefix() {
        return 'intervention';
    }
}
