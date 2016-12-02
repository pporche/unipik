<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 29/04/16
 * Time: 08:34
 *
 * PHP version 5
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\UserBundle\Form\Profile;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\F;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class ConfirmationType
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class ConfirmationType extends AbstractFieldsetType {

    /**
     * Build le formulaire
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add(
                'current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
                'label' => 'Mot de passe',
                'translation_domain' => 'FOSUserBundle',
                'mapped' => false,
                'constraints' => new UserPassword(),
                )
            )
            ->add('_submit', SubmitType::class, array('label' => 'Confirmer'));
    }

    /**
     * {@inheritdoc}
     * Renvoie confirmation
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'confirmation';
    }
}
