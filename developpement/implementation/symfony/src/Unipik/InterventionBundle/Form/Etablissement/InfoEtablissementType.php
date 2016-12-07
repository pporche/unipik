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

namespace Unipik\InterventionBundle\Form\Etablissement;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;

/**
 * Le type info etablissement
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class InfoEtablissementType extends AbstractFieldsetType {

    /**
     * Formbuilder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', TextType::class, array('label' => "Nom de l'établissement", 'attr' => ['maxlength' => '100']));
    }

    /**
     * {@inheritdoc}
     * Renvoie adresse
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'adresse';
    }
}
