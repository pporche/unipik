<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 27/04/16
 * Time: 08:31
 */

namespace Unipik\ArchitectureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class VilleType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('', TextType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent() {
        return TextType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'addresse';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
