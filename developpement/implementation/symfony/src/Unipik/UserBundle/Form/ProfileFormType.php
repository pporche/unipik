<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 29/04/16
 * Time: 08:25
 */

namespace Unipik\UserBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Unipik\UserBundle\Form\Adresse\AdresseType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfileFormType extends AbstractType
{

    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
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
            ->add('responsabiliteActivite', ChoiceType::class, $optionResponsabilite);
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix() {
        return 'user_profile';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }

}
