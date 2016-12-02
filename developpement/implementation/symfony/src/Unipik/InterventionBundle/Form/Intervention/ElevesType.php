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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;

/**
 * Le type eleves
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class ElevesType extends AbstractType {

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder Le builder
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder) {
        $builder
            ->add('nbEleves', IntegerType::class, array('label' => 'Nombre'));
    }

    /**
     * {@inheritdoc}
     * Renvoie eleves
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'eleves';
    }
}
