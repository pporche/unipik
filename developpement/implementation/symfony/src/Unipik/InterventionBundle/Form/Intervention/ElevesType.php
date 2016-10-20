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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;

class ElevesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * form builder
     */
    public function buildForm(FormBuilderInterface $builder){
        $builder
            ->add('nbEleves', IntegerType::class, array('label' => 'Nombre'))
        ;
    }

    /**
     * {@inheritdoc}
     * renvoie eleves
     */
    public function getBlockPrefix() {
        return 'eleves';
    }
}
