<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 27/04/16
 * Time: 11:12
 */

namespace Unipik\InterventionBundle\Form\Etablissement;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Unipik\UserBundle\Form\Adresse\NumeroDeRueType;

class PersonneReferenteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('nom', TextType::class)
            ->add('email', TextType::class)
            ->add('telephone', NumeroDeRueType::class, array('label' => "Téléphone"))
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
        $resolver->setDefaults([
            'data_class' => 'Unipik\UserBundle\Entity\Adresse',
            'fieldset' => true,
            'legend' => "",
        ]);
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
