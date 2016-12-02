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
 * Le type jour intervention
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class JourInterventionType extends AbstractType {

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $optionChoiceType = array( 'expanded' => true, 'multiple' => false, 'choices' => [
            'Matin' => 'matin',
            'Après-Midi' => 'apres-midi',
            'Matin ou Après-Midi' => 'indifferent',
            'Jour à éviter' => 'a-eviter',
        ],);

        $builder
            ->add('lundi', ChoiceType::class, $optionChoiceType)
            ->add('mardi', ChoiceType::class, $optionChoiceType)
            ->add('mercredi', ChoiceType::class, $optionChoiceType)
            ->add('jeudi', ChoiceType::class, $optionChoiceType)
            ->add('vendredi', ChoiceType::class, $optionChoiceType)
            ->add('samedi', ChoiceType::class, $optionChoiceType);
    }

    /**
     * {@inheritdoc}
     * Renvoie jour_intervention
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'jour_intervention';
    }
}
