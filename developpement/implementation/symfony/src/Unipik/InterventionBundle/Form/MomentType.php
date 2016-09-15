<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 13/09/16
 * Time: 10:46
 */

namespace Unipik\InterventionBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MomentType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $optionChoiceType = array( 'expanded' => true, 'multiple' => true,
            'choices' => [
                'Matin' => 'matin',
                'Après-Midi' => 'aprem',
                'Soir' => 'soir'
            ],);

        $builder
            ->add('Moment', ChoiceType::class, $optionChoiceType)
        ;
    }

}
