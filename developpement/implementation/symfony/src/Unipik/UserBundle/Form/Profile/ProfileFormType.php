<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 29/04/16
 * Time: 08:25
 */

namespace Unipik\UserBundle\Form\Profile;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);

        $builder
            ->add('confirmation', ConfirmationType::class, array('fieldset' => true, 'legend' => "Confirmer les modifications"))
        ;

    }

    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => "Nom d'utilisateur"))
            ->add('email', EmailType::class, array('label' => 'Adresse email'))
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
