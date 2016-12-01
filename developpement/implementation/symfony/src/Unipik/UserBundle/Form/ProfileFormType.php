<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 29/04/16
 * Time: 08:25
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

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\Adresse\AdresseType;

/**
 * Class ProfileFormType
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class ProfileFormType extends BaseType {

    /**
     * ProfileFormType constructor.
     *
     * @param string $class La classe
     *
     * @return object
     */
    public function __construct($class) {
        parent::__construct($class);
    }

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

        $optionActivite = array( 'required'=>false, 'expanded' => true, 'multiple' => true, 'mapped' => false, 'label' => 'Activités potentielles',
            'choices' => [
                'Actions ponctuelles' => 'actions_ponctuelles',
                'Actions éducatives' => 'plaidoyers',
                'Frimousses' => 'frimousses',
                'Projets' => 'projets',
                'Autre' => 'autre',
            ],);

        $optionResponsabilite = array( 'required'=>false, 'expanded' => true, 'multiple' => true, 'mapped' => false, 'label' => 'Responsable d\'activité',
            'choices' => [
                'Actions ponctuelles' => 'actions_ponctuelles',
                'Actions éducatives' => 'plaidoyers',
                'Frimousses' => 'frimousses',
                'Projets' => 'projets',
                'Administrateur Régional' => 'admin_region',
                'Administrateur Comité' => 'admin_comite',
            ],);

        $builder
            ->add('adresse', AdresseType::class)
            ->add('responsabiliteActivite', ChoiceType::class, $optionResponsabilite)
            ->add('activitesPotentielles', ChoiceType::class, $optionActivite);
    }

    /**
     * Build the form for user creation
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options) {
        parent::buildUserForm($builder, $options);

        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('nom')
            ->add('prenom', TextType::class, array('label' => 'Prénom'))
            ->add('telfixe', TextType::class, array( 'required'=>false, 'label' => 'Téléphone fixe'))
            ->add('telportable', TextType::class, array( 'required'=>false, 'label' => 'Téléphone portable'));
    }

    /**
     * Renvoie le parent
     *
     * @return string
     */
    public function getParent() {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    /**
     * Renvoie user_profile
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'user_profile';
    }
}
