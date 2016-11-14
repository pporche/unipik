<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 27/04/16
 * Time: 12:58
 */

namespace Unipik\ArchitectureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractFieldsetType extends AbstractType {


    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);


        $view->vars = array_replace(
            $view->vars, array(
            'fieldset' => $options['fieldset'],
            'legend' => $options['legend']
            )
        );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(
            array(
            'fieldset' => true,
            'legend' => "",
            )
        );
    }

}
