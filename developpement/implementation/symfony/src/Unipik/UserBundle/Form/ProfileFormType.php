<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 29/04/16
 * Time: 08:25
 */

namespace Unipik\UserBundle\Form;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\UserBundle\Form\Adresse\AdresseType;

class ProfileFormType extends BaseType  {

    public function __construct($class) {
        parent::__construct($class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $optionChoiceType = array( 'expanded' => true, 'multiple' => true, 'label' => 'Rôle',
            'choices' => [
                'Utilisateur' => 'ROLE_USER',
                'Administrateur' => 'ROLE_ADMIN',
            ]);

        $optionActivite = array( 'expanded' => true, 'multiple' => true, 'mapped' => false, 'label' => 'Activités potentielles',
            'choices' => [
                'Actions ponctuelles' => '(actions ponctuelles)',
                'Plaidoyers' => '(plaidoyers)',
                'Frimousses' => '(frimousses)',
                'Projets' => '(projets)',
                'Autre' => '(autre)',
            ],);

        $optionResponsabilite = array( 'expanded' => true, 'multiple' => true, 'mapped' => false, 'label' => 'Responsable d\'activité',
            'choices' => [
                'Actions ponctuelles' => '(actions ponctuelles)',
                'Plaidoyers' => '(plaidoyers)',
                'Frimousses' => '(frimousses)',
                'Projets' => '(projets)',
                'Administrateur Régional' => '(admin_region)',
                'Administrateur Comité' => '(admin_comite)',
            ],);

        $builder
            ->add('adresse', AdresseType::class)
            ->add('roles', ChoiceType::class, $optionChoiceType)
            ->add('responsabiliteActivite', ChoiceType::class, $optionResponsabilite)
            ->add('activitesPotentielles', ChoiceType::class, $optionActivite)
        ;
    }

    protected function buildUserForm(FormBuilderInterface $builder, array $options) {
        parent::buildUserForm($builder, $options);

        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('nom')
            ->add('telfixe')
            ->add('prenom')
        ;
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
