<?php
/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 12/10/16
 * Time: 19:54
 */

namespace Unipik\InterventionBundle\Form\Intervention;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;
use Unipik\ArchitectureBundle\Form\NiveauThemeType;

class InterventionType extends AbstractFieldsetType {


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('dateIntervention', DateType::class, array(
                'widget' => 'single_text',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd-MM-yyyy',
                'required' => false
            ))
            ->add('lieu', TextType::class)
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