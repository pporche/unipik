<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 16/11/16
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
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\CodePostalAutoCompleteTransformer;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\DepartementAutocompleteTransformer;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\VilleAutocompleteTransformer;
use Unipik\InterventionBundle\Form\DataTransformer\Etablissement\EtablissementAutocompleteTransformer;
use Unipik\InterventionBundle\Form\Intervention\InterventionTemplateType;
use Unipik\InterventionBundle\Form\Intervention\JourInterventionType;
use Unipik\InterventionBundle\Form\Intervention\PlageDateType;
use Unipik\UserBundle\Form\ContactType;
use Gregwar\CaptchaBundle\Type\CaptchaType;


/**
 * Le type demande
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class DemandeAnonymeType extends AbstractType {
    private $entityManager;

    /**
     * DepartementType constructor.
     *
     * @param ObjectManager $entityManager Le manager
     *
     * @return void
     */
    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $generalType = array('required' => true, 'mapped' => false,
            'label' => 'Type d\'établissement',
            'choices' => [
                'Enseignement' => 'ens',
                'Centre de loisirs' => 'centre',
                'Autre' => 'autre'
            ],);

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

        $builder
            ->add('departement', TextType::class, array('mapped' => false, 'label' => 'Département', 'attr' => ['maxlength' => '100']))
            ->add('ville', TextType::class, array('mapped' => false, 'label' => 'Ville', 'attr' => ['maxlength' => '100']))
            ->add('typeGeneral', ChoiceType::class, $generalType)
            ->add('typeEnseignement', ChoiceType::class, $educationChoiceType)
            ->add('typeAutreEtablissement', ChoiceType::class, $otherChoiceType)
            ->add('typeCentre', ChoiceType::class, $centerChoiceType)
            ->add('nomEtablissement', TextType::class, array('mapped' => false, 'label' => 'Nom établissement*', 'required' => 'true', 'attr' => ['maxlength' => '100']))
            ->add('plageDate', PlageDateType::class, array('label' => 'Plage de dates', 'mapped' => false))
            ->add('jour', JourInterventionType::class, array('label' => "Jour de l'intervention", 'mapped' => false))
            ->add(
                'Intervention', CollectionType::class, array('entry_type' => InterventionTemplateType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'mapped' => false
                )
            )
            ->add('Contact', ContactType::class, array('label' => false))
            ->add('Code_visuel', CaptchaType::class)
            ->add('Valider_la_demande', SubmitType::class)
            ;

        $builder->get("ville")->addModelTransformer(new VilleAutocompleteTransformer($this->entityManager));
        $builder->get("departement")->addModelTransformer(new DepartementAutocompleteTransformer($this->entityManager));
        $builder->get("nomEtablissement")->addModelTransformer(new EtablissementAutocompleteTransformer($this->entityManager));

    }

    /**
     * Configurer les options
     *
     * @param OptionsResolver $resolver Le resolver
     *
     * @return object
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            array(
                'data_class' => 'Unipik\InterventionBundle\Entity\Demande'
            )
        );
    }

}
