<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 14:50
 */

namespace Unipik\InterventionBundle\Form\Intervention;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;

class PlageDateType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('debut', DateType::class,array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'dd/MM/yyyy',
                'label'  => 'Début'
            ))
            ->add('fin', DateType::class,array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'dd/MM/yyyy'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'plage_date';
    }
}
