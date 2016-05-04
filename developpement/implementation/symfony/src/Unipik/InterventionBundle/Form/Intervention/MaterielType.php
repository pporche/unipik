<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 15:14
 */

namespace Unipik\InterventionBundle\Form\Intervention;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;

class MaterielType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $optionChoiceType = array( 'expanded' => true, 'multiple' => true,
            'choices' => [
            'Vidéo projecteur' => 'videopro',
            'Enceinte(s)' => 'enceintes',
            'TBI' => 'tbi'
        ],);

        $builder
            ->add('materiel', ChoiceType::class, $optionChoiceType)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'materiel';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
