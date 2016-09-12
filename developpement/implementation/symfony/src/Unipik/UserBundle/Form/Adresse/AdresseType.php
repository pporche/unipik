<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 27/04/16
 * Time: 08:31
 */

namespace Unipik\UserBundle\Form\Adresse;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\F;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;

class AdresseType extends AbstractFieldsetType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('ville', VilleType::class)
            ->add('adresse', AdType::class)
            ->add('codePostal', CodePostalType::class)
            ->add('complement', ComplementType::class, array('label' => "Complément"))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver){
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => 'Unipik\ArchitectureBundle\Entity\Adresse',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'adresse';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
