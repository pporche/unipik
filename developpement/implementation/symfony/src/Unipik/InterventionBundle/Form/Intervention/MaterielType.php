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
use Symfony\Component\Form\AbstractType;

/**
 * Le type materiel
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class MaterielType extends AbstractType {

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $optionChoiceType = array( 'expanded' => true, 'multiple' => true, 'label' => false, 'required' => true,
            'choices' => [
            'Vidéo projecteur' => 'videoprojecteur',
            'Enceinte(s)' => 'enceinte',
            'Tableau intéractif' => 'tableau interactif',
            'Autres' => 'autre'
            ],);

        $builder
            ->add('materiel', ChoiceType::class, $optionChoiceType);
    }

    /**
     * {@inheritdoc}
     * renvoie materiel
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'materiel';
    }
}
