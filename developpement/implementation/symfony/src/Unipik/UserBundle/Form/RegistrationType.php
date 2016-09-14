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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Unipik\UserBundle\Form\Adresse\AdresseType;

class RegistrationType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $optionChoiceType = array( 'expanded' => true, 'multiple' => true,
            'choices' => [
                'User' => 'ROLE_USER',
                'Admin' => 'ROLE_ADMIN',
            ],);

        $optionActivite = array( 'expanded' => true, 'multiple' => true, 'mapped' => false,
            'choices' => [
                'Actions ponctuelles' => '(actions ponctuelles)',
                'Plaidoyers' => '(plaidoyers)',
                'Frimousses' => '(frimousses)',
                'Projets' => '(projets)',
                'Autre' => '(autre)',
            ],);

        $optionResponsabilite = array( 'expanded' => true, 'multiple' => true, 'mapped' => false,
            'choices' => [
                'Actions ponctuelles' => '(actions ponctuelles)',
                'Plaidoyers' => '(plaidoyers)',
                'Frimousses' => '(frimousses)',
                'Projets' => '(projets)',
                'Admin Région' => '(admin_region)',
                'Admin Comité' => '(admin_comite)',
            ],);

        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telFixe')
            ->add('telPortable')
            ->add('email')
            ->add('adresse', AdresseType::class)
            ->add('roles', ChoiceType::class, $optionChoiceType)
            ->add('activitesPotentielles', ChoiceType::class, $optionActivite)
            ->add('responsabiliteActivite', ChoiceType::class, $optionResponsabilite)
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
