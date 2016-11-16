<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 15:14
 */

namespace Unipik\MailBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;
use Unipik\ArchitectureBundle\Form\Adresse\CodePostalType;
use Unipik\ArchitectureBundle\Form\Adresse\VilleType;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\CodePostalAutoCompleteTransformer;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\VilleAutocompleteTransformer;

/**
 * Class MailingType
 *
 * @package Unipik\MailBundle\Form
 */
class MailingType extends AbstractFieldsetType {
    private $entityManager;

    /**
     * MailingType constructor.
     * @param ObjectManager $entityManager
     */
    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $typeInstitute = array( 'expanded' => true, 'multiple' => true, 'label' => "Type d'établissement",
            'choices' => [
                'Maternelle' => 'maternelle',
                'Elémentaire' => 'elementaire',
                'Collège' => 'college',
                'Lycée' => 'lycee',
                'Supérieur' => 'superieur'
            ],);

        $typeCenter = array( 'expanded' => true, 'multiple' => true, 'label' => "Type de centre de loisirs",
            'choices' => [
                'Maternelle' => 'maternelle',
                'Elémentaire' => 'elementaire',
                'Adolescent' => 'college',
                'autre' => 'autre'
            ],);

        $typeAutreEtablissement = array( 'expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false, 'label' => "Type autre établissement",
            'choices' => [
                'Mairie' => 'mairie',
                'Maison de retraite' => 'maison de retraite',
                'Autre' => 'autre'
            ],);

        $relance = array( 'expanded' => true, 'multiple' => false, 'label' => "Type d'envoi", 'required' => false,
            'choices' => [
                'Non réponse à une précédente sollicitation pour cette année scolaire' => 'relance',
                'Réponse à une précédente sollicitation (frimousses ou action pontuelles mais pas plaidoyers)' => 'relancePlaidoyer'
            ],);

        $builder
            ->add('typeInstitute', ChoiceType::class, $typeInstitute)
            ->add('typeCenter', ChoiceType::class, $typeCenter)
            ->add('typeAutre', ChoiceType::class, $typeAutreEtablissement)
            ->add('typeRelance', ChoiceType::class, $relance)
            ->add('ville', VilleType::class, array('required' => false))
            ->add('codePostal', CodePostalType::class, array('required' => false))
        ;

        $builder->get("ville")->addModelTransformer(new VilleAutocompleteTransformer($this->entityManager));
        $builder->get("codePostal")->addModelTransformer(new CodePostalAutocompleteTransformer($this->entityManager));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'mailing';
    }
}
