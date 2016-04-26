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

class LoginType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /*parent::buildForm($builder, $options);
        $builder
        ;*/

        $builder
            ->add('username', null, array('label' => 'Nom d\'utilisateur'))
            ->add('password', null, array('label' => 'Mot de passe' ))
        ;

    }

    public function getBlockPrefix() {
        return 'user_login';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
