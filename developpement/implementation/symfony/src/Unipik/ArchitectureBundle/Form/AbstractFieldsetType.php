<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 27/04/16
 * Time: 12:58
 *
 * PHP version 5
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\ArchitectureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Manage the abstract fieldsets
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
abstract class AbstractFieldsetType extends AbstractType {


    /**
     * {@inheritdoc}
     * Builds the view
     *
     * @param FormView      $view    La vue
     * @param FormInterface $form    Le form
     * @param array         $options Les options
     *
     * @return void
     */
    public function buildView(FormView $view, FormInterface $form, array $options) {
        parent::buildView($view, $form, $options);
        $view->vars = array_replace(
            $view->vars, array(
            'fieldset' => $options['fieldset'],
            'legend' => $options['legend']
            )
        );
    }

    /**
     * Configure les options
     *
     * @param OptionsResolver $resolver Le resolver
     *
     * @return void
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
