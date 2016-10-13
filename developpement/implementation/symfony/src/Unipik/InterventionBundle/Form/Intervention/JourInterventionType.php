<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 14:57
 */

namespace Unipik\InterventionBundle\Form\Intervention;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;

class JourInterventionType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * form builder
     */
    public function buildForm(FormBuilderInterface $builder, array $options){

        $optionChoiceType = array( 'expanded' => true, 'multiple' => false, 'choices' => [
            'Matin' => 'matin',
            'Après-Midi' => 'apres-midi',
            'Matin ou Après-Midi' => 'indifferent',
            'Jour à éviter' => 'a-eviter',
        ],);

        $builder
            ->add('lundi', ChoiceType::class, $optionChoiceType)
            ->add('mardi', ChoiceType::class, $optionChoiceType)
            ->add('mercredi', ChoiceType::class, $optionChoiceType)
            ->add('jeudi', ChoiceType::class, $optionChoiceType)
            ->add('vendredi', ChoiceType::class, $optionChoiceType)
        ;
    }

    /**
     * {@inheritdoc}
     * renvoie jour_intervention
     */
    public function getBlockPrefix() {
        return 'jour_intervention';
    }
}
