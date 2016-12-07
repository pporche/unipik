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
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LoginType
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class LoginType extends AbstractType {

    /**
     * Le formbuilder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->setAction($options['action'])
            ->setMethod('POST')
            ->add('_username', TextType::class, array('label' => 'Nom d\'utilisateur', 'attr' => ['maxlength' => '100']))
            ->add('_password', PasswordType::class, array('label' => 'Mot de passe', 'attr' => ['maxlength' => '100']))
            ->add(
                '_remember_me', CheckboxType::class, array(
                'label' => 'Rester connecté',
                'required' => false,
                )
            )
            ->add('_submit', SubmitType::class, array('label' => 'Connexion'));

    }

    /**
     * Configuration des options
     *
     * @param OptionsResolver $resolver Le resolver
     *
     * @return object
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            array(
            'action' => '/',
            )
        );
    }

    /**
     * Retourne chaine vide
     *
     * @return string
     */
    public function getBlockPrefix() {
        return '';
    }
}
