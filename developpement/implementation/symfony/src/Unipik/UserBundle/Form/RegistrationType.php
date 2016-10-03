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
use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Unipik\ArchitectureBundle\Form\Adresse\AdresseType;
use Unipik\ArchitectureBundle\Form\Adresse\VilleType;

/**
 * Class RegistrationType
 * @package Unipik\UserBundle\Form
 */
class RegistrationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $optionChoiceType = array( 'expanded' => true, 'multiple' => true, 'label' => 'Rôle',
            'choices' => [
                'Utilisateur' => 'ROLE_USER',
                'Administrateur' => 'ROLE_ADMIN',
            ]);

        $optionActivite = array( 'expanded' => true, 'multiple' => true, 'mapped' => false, 'label' => 'Activités potentielles',
            'choices' => [
                'Actions ponctuelles' => '(actions_ponctuelles)',
                'Plaidoyers' => '(plaidoyers)',
                'Frimousses' => '(frimousses)',
                'Projets' => '(projets)',
                'Autre' => '(autre)',
            ],);

        $optionResponsabilite = array( 'expanded' => true, 'multiple' => true, 'mapped' => false, 'label' => 'Responsable d\'activité',
            'choices' => [
                'Actions ponctuelles' => '(actions_ponctuelles)',
                'Plaidoyers' => '(plaidoyers)',
                'Frimousses' => '(frimousses)',
                'Projets' => '(projets)',
                'Administrateur Régional' => '(admin_region)',
                'Administrateur Comité' => '(admin_comite)',
            ],);

        $builder
            ->add('nom')
            ->add('prenom', TextType::class, array('label' => 'Prénom'))
            ->add('telFixe', TextType::class, array('label' => 'Téléphone fixe'))
            ->add('telPortable', TextType::class, array('label' => 'Téléphone portable'))
            ->add('email', TextType::class, array('label' => 'E-mail'))
            ->add('username', TextType::class, array('label' => 'Nom d\'utilisateur'))
            ->add('plainPassword', RepeatedType::class,
                    array('type' => PasswordType::class,
                          'first_options'  => array('label' => 'Mot de passe'),
                          'second_options' => array('label' => 'Confirmer le mot de passe')
                    )
                 )
            ->add('adresse', AdresseType::class)
            ->add('roles', ChoiceType::class, $optionChoiceType)
            ->add('responsabiliteActivite', ChoiceType::class, $optionResponsabilite)
            ->add('activitesPotentielles', ChoiceType::class, $optionActivite)
        ;
    }

    /**
     * @return string
     */
    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
     * @return string
     */
    public function getBlockPrefix() {
        return 'user_registration';
    }
}
