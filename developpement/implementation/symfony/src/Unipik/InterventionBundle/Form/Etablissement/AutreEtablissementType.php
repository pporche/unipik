<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 13/09/16
 * Time: 15:15
 */

namespace Unipik\InterventionBundle\Form\Etablissement;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AutreEtablissementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $optionChoiceType = array( 'expanded' => true, 'multiple' => true, 'mapped' => false,
            'choices' => [
                'Mairie' => '(mairie)',
                'Maison de retraite' => '(maison de retraite)',
                'Autre' => '(autre)'
            ],);

        $builder
            ->add('Alternative', ChoiceType::class, $optionChoiceType)
        ;
    }
}
