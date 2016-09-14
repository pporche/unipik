<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 13/09/16
 * Time: 14:26
 */

namespace Unipik\InterventionBundle\Form\Etablissement;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TypeEnseignementType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $optionChoiceType = array( 'expanded' => true, 'multiple' => true, 'mapped' => false,
            'choices' => [
                'Maternelle' => '(maternelle)',
                'Elementaire' => '(elementaire)',
                'Collège' => '(college)',
                'Lycée' => '(lycee)',
                'Supérieur' => '(superieur)'
            ],);

        $builder
            ->add('Niveau', ChoiceType::class, $optionChoiceType)
        ;
    }
}
