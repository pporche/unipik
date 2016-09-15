<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 29/04/16
 * Time: 08:25
 */

namespace Unipik\UserBundle\Form\Profile;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends BaseType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

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
            ->add('activitesPotentielles', ChoiceType::class, $optionResponsabilite)
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
