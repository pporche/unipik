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
 * Le type theme
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class ThemesType extends AbstractType {

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $optionChoiceType = array( 'label' => false, 'attr' => ['class' => 'form-theme-pld'],
            'choices' => [
                "Convention internationale des Droits de l'Enfant" => 'convention internationale des droits de l enfant',
                "L'éducation" => 'education',
                "Le rôle de l'Unicef" => 'role unicef',
                "La santé (en général)" => 'sante en generale',
                "La santé - Alimentation" => 'sante et alimentation',
                "L'eau" => 'eau',
                "Le harcèlement" => 'harcelement',
                "Le travail des enfants" => 'travail des enfants',
                "Les enfants soldats" => 'enfants et soldats',
                "Les urgences mondiales" => 'urgences mondiales',
                "VIH et sida" => 'VIH et sida',
                "Les discriminations" => 'discrimination',
                "Le millénaire pour le développement" => 'millenaire dev',
            ],);

        $builder
            ->add('themes', ChoiceType::class, $optionChoiceType);
    }

    /**
     * Renvoie themes
     * {@inheritdoc}
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'themes';
    }
}
