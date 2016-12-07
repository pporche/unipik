<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 20/04/16
 * Time: 08:35
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
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class RegistrationType extends AbstractType {

    /**
     * Build a form
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
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
                'Actions ponctuelles' => 'actions_ponctuelles',
                'Actions éducatives' => 'plaidoyers',
                'Frimousses' => 'frimousses',
                'Projets' => 'projets',
                'Autre' => 'autre',
            ],);

        $optionResponsabilite = array( 'expanded' => true, 'multiple' => true, 'mapped' => false, 'label' => 'Responsable d\'activité',
            'choices' => [
                'Actions ponctuelles' => 'actions_ponctuelles',
                'Actions éducatives' => 'plaidoyers',
                'Frimousses' => 'frimousses',
                'Projets' => 'projets',
                'Administrateur Régional' => 'admin_region',
                'Administrateur Comité' => 'admin_comite',
            ],);

        $builder
            ->add('nom', TextType::class, array('attr'=> ['maxlength' => '100']))
            ->add('prenom', TextType::class, array('label' => 'Prénom', 'attr'=> ['maxlength' => '100']))
            ->add('telFixe', TextType::class, array('label' => 'Téléphone fixe', 'required' => false, 'attr' => ['maxlength' => '30']))
            ->add('telPortable', TextType::class, array('label' => 'Téléphone portable', 'required' => false, 'attr' => ['maxlength' => '30']))
            ->add('email', TextType::class, array('label' => 'E-mail', 'attr' => ['maxlength' => '100']))
            ->add('username', TextType::class, array('label' => 'Nom d\'utilisateur', 'attr' => ['maxlength' => '100']))
            ->add(
                'plainPassword', RepeatedType::class,
                array('type' => PasswordType::class,
                          'first_options'  => array('label' => 'Mot de passe'),
                          'second_options' => array('label' => 'Confirmer le mot de passe'),
                    'attr' => ['maxlength' => '100']
                    )
            )
            ->add('adresse', AdresseType::class)
            ->add('roles', ChoiceType::class, $optionChoiceType)
            ->add('responsabiliteActivite', ChoiceType::class, $optionResponsabilite)
            ->add('activitesPotentielles', ChoiceType::class, $optionActivite);
    }

    /**
     * Renvoie le parent
     *
     * @return string
     */
    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
     * Renvoie user_registration
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'user_registration';
    }
}
