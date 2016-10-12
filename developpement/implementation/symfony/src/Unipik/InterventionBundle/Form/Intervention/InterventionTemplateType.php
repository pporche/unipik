<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 14:34
 */

namespace Unipik\InterventionBundle\Form\Intervention;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('materielDispoPlaidoyer', MaterielType::class, array('label' => 'Matériel'))
            ->add('materiauxFrimousse',MaterielFrimousseType::class, array('label' => 'Matériel frimousse'))
            ->add('nbPersonne', IntegerType::class, array('label' => 'Participants'))
            ->add('niveauTheme', NiveauThemeType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'intervention';
    }
}
