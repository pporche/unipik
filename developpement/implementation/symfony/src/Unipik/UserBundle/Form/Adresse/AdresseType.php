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

class AdresseType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('ville', VilleType::class)
            ->add('rue', RueType::class)
            ->add('codePostal', CodePostalType::class)
            ->add('numeroDeRue', NumeroDeRueType::class, array('label' => "N° de rue"))
            ->add('complement', ComplementType::class, array('label' => "Complément"))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);


        $view->vars = array_replace($view->vars, array(
            'fieldset' => $options['fieldset'],
            'legend' => $options['legend']
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'Unipik\UserBundle\Entity\Adresse',
            'fieldset' => true,
            'legend' => "",
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
