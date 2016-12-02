<?php
/**
 * Created by PhpStorm.
 * User: Kafui
 * Date: 13/09/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\InterventionBundle\Form\Intervention;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;

/**
 * Le type plage de dates
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class PlageDateType extends AbstractType {

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add(
                'debut', DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'dd/MM/yyyy',
                'label'  => 'Début'
                )
            )
            ->add(
                'fin', DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'dd/MM/yyyy'
                )
            );
    }

    /**
     * {@inheritdoc}
     * Renvoie plage_date
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'plage_date';
    }
}
