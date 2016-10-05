<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 04/10/16
 * Time: 10:51
 */

namespace Unipik\InterventionBundle\Form\Intervention;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;

class MaterielFrimousseType extends AbstractType{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $optionChoiceType = array( 'expanded' => true, 'multiple' => true, 'label' => false,
            'choices' => [
                'Patron' => '(patron)',
                'Bourre' => '(bourre)',
                'Décoration' => '(decoration)',
            ],);

        $builder
            ->add('materiel', ChoiceType::class, $optionChoiceType)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'materielFrimousse';
    }
}
