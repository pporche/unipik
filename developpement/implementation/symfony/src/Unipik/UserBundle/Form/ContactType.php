<?php
/**
 * Created by PhpStorm.
 * User: Kafui
 * Date: 13/09/16
 * Time: 11:55
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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Unipik\InterventionBundle\Form\EtablissementType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ContactType
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class ContactType extends AbstractType {

    /**
     * Le form builder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('email', TextType::class, array('attr' => ['maxlength' => '100']))
            ->add('nom', TextType::class, array('label' => false, 'attr' => ['maxlength' => '100']))
            ->add('prenom', TextType::class, array('label' => false, 'required' => false, 'attr' => ['maxlength' => '100']))
            ->add('telFixe', TextType::class, array('label' => 'Téléphone fixe', 'required' => false, 'attr' => ['maxlength' => '30']))
            ->add('telPortable', TextType::class, array('label' => 'Téléphone portable', 'required' => false, 'attr' => ['maxlength' => '30']))
            ->add(
                'typeContact', ChoiceType::class, array(
                'choices' => array(
                    'Enseignant' => 'enseignant',
                    'Étudiant' => 'etudiant',
                    'Animateur' => 'animateur',
                    'Élève' => 'eleve',
                    'Autre' => 'autre'
                )
                )
            )
            ->add('respoEtablissement', CheckBoxType::class, array('label' => 'Êtes vous le chef d\'établissement ?', 'required' => false));
    }

    /**
     * Configuration des options
     *
     * @param OptionsResolver $resolver Le resolver
     *
     * @return object
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            array(
            'data_class' => 'Unipik\UserBundle\Entity\Contact'
            )
        );
    }
}
