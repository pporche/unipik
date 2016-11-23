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
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\InterventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Unipik\InterventionBundle\Form\Etablissement\TypeCentreType;
use Unipik\UserBundle\Form\ContactType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Unipik\InterventionBundle\Form\Etablissement\TypeEnseignementType;
use Unipik\ArchitectureBundle\Form\Adresse\AdresseType;
use Unipik\InterventionBundle\Form\Etablissement\AutreEtablissementType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;

/**
 * Le type etablissement
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class EtablissementType extends AbstractType {
    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $educationChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false, 'required' => false, 'placeholder' => false,
            'label' => 'Type d\'enseignement',
            'choices' => [
                'Maternelle' => 'maternelle',
                'Élémentaire' => 'elementaire',
                'Collège' => 'college',
                'Lycée' => 'lycee',
                'Supérieur' => 'superieur'
            ]);

        $centerChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false, 'required' => false, 'placeholder' => false,
            'label' => 'Type de public du centre',
            'choices' => [
                'Maternelle' => 'maternelle',
                'Élémentaire' => 'elementaire',
                'Adolescent' => 'adolescent',
                'Autre' => 'autre',
            ],);

        $otherChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false, 'required' => false, 'placeholder' => false,
            'label' => 'Type d\'établissement',
            'choices' => [
                'Mairie' => 'mairie',
                'Maison de retraite' => 'maison de retraite',
                'Autre' => 'autre'
            ],);

        $generalType = array('required' => true, 'mapped' => false,
            'label' => 'Type d\'établissement',
            'choices' => [
                'Enseignement' => 'ens',
                'Centre de loisirs' => 'centre',
                'Autre' => 'autre'
            ],);

        $builder

            ->add('nom', TextType::class, array('required' => false))
            ->add('telFixe', TextType::class, array('label' => 'Téléphone fixe', 'required' => false))
            ->add(
                'emails', CollectionType::class, array('label'=> false,'mapped' => false,
                'entry_type'   => TextType::class,
                'allow_add'    => true,
                'allow_delete' => true
                )
            )
            ->add('TypeGeneral', ChoiceType::class, $generalType)
            ->add('typeEnseignement', ChoiceType::class, $educationChoiceType)
            ->add('typeAutreEtablissement', ChoiceType::class, $otherChoiceType)
            ->add('typeCentre', ChoiceType::class, $centerChoiceType)
            ->add('uai', TextType::class, array('label' => 'Unité Administrative Immatriculée' ,'required' => false))
            ->add('adresse', AdresseType::class, array('required'=>true));
    }
    /**
     * Configure les options
     *
     * @param OptionsResolver $resolver Le resolver
     *
     * @return object
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            array(
            'data_class' => 'Unipik\InterventionBundle\Entity\Etablissement'
            )
        );
    }
}
