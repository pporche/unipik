<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 14/09/16
 * Time: 13:59
 */

namespace Unipik\InterventionBundle\Form\Intervention;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;



class RechercheAvanceeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $optionChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false, 'required' => false,
            'choices' => [
                'Toutes' => '',
                'Plaidoyers' => 'plaidoyer',
                'Frimousses' => 'frimousse',
                'Autres interventions' => 'autreIntervention'
            ],);

        $statutChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false, 'required' => false,
            'choices' => [
                'Toutes' => '',
                'Attribuées' => 'attribuees',
                'Non attribuées' => 'nonAttribuees',
                'réalisées' => 'realisees',
            ],);

        $builder
            ->add('typeIntervention', ChoiceType::class, $optionChoiceType)
            ->add('statutIntervention', ChoiceType::class, $statutChoiceType)
            ->add('date', CheckboxType::class, array(
                'label'    => 'Toutes',
                'required' => false,
            ))
            ->add('start', DateType::class, array(
                'widget' => 'single_text',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd-MM-yyyy',
                'required' => false
            ))
            ->add('end', DateType::class, array(
                'widget' => 'single_text',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd-MM-yyyy',
                'required' => false
            ))
        ;
    }

}
