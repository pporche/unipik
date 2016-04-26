<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 20/04/16
 * Time: 08:35
 */

namespace Unipik\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /*parent::buildForm($builder, $options);
        $builder
        ;*/

        $builder
            ->setAction($options['action'])
            ->setMethod('POST')
            ->add('_username', TextType::class, array(
                'label' => 'Nom d\'utilisateur',
                'required' => false,
            ))
            ->add('_password', PasswordType::class, array('label' => 'Mot de passe' ))
            ->add('_remember_me', CheckboxType::class, array('label' => 'Rester connecté'))
            ->add('_submit', SubmitType::class, array('label' => 'Connexion'))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'action' => '/',
        ));
    }

    public function getBlockPrefix() {
        return '';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
