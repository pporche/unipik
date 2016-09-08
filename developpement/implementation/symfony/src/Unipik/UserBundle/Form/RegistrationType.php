<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 20/04/16
 * Time: 08:35
 */

namespace Unipik\UserBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\UserBundle\Form\Adresse\AdresseType;

class RegistrationType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $optionChoiceType = array( 'expanded' => true, 'multiple' => true,
            'choices' => [
                'User' => 'ROLE_USER',
                'Admin' => 'ROLE_ADMIN',
            ],);



        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telFixe')
            ->add('telPortable')
            ->add('email')
            ->add('adresse', AdresseType::class)
            ->add('roles', ChoiceType::class, $optionChoiceType)
        ;
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix() {
        return 'user_registration';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
