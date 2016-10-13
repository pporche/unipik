<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 15:50
 */

namespace Unipik\InterventionBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;

class RemarquesType extends AbstractFieldsetType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * form builder
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('remarques', TextareaType::class)
        ;
    }

    /**
     * {@inheritdoc}
     * renvoie remarques
     */
    public function getBlockPrefix() {
        return 'remarques';
    }
}
