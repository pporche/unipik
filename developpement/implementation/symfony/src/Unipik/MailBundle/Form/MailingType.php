<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 15:14
 *
 * PHP version 5
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\MailBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class MailingType extends AbstractFieldsetType {
    private $entityManager;

    /**
     * MailingType constructor.
     *
     * @param ObjectManager $entityManager Le manager
     */
    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Le formbuilder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $typeInstitute = array( 'expanded' => true, 'multiple' => true, 'label' => "Type d'établissement",
            'choices' => [
                'Tous les types' => 'tous',
                'Maternelle' => 'maternelle',
                'Elémentaire' => 'elementaire',
                'Collège' => 'college',
                'Lycée' => 'lycee',
                'Supérieur' => 'superieur'
            ],);

        $typeCenter = array( 'expanded' => true, 'multiple' => true, 'label' => "Type de centre de loisirs",
            'choices' => [
                'Tous les types' => 'tous',
                'Maternelle' => 'maternelle',
                'Elémentaire' => 'elementaire',
                'Adolescent' => 'college',
                'Autre' => 'autre'
            ],);

        $typeAutreEtablissement = array( 'expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false, 'label' => "Type autre établissement",
            'choices' => [
                'Tous les types' => 'tous',
                'Mairie' => 'mairie',
                'Maison de retraite' => 'maison de retraite',
                'Autre' => 'autre'
            ],);

        $relance = array( 'expanded' => true, 'multiple' => false, 'label' => "Type d'envoi", 'required' => false,
            'placeholder' => 'Par défaut',
            'choices' => [
                'Non réponse à une précédente sollicitation pour ce niveau scolaire' => 'relance',
                'Réponse à une précédente sollicitation (frimousses ou action pontuelles mais pas plaidoyers)' => 'relancePlaidoyer'
            ],);

        $dansVilleOuParDistance = array('required' => false, 'expanded' => true, 'multiple' => false, 'label' => 'Envoi par localisation',
            'placeholder' => 'Par défaut',
            'choices' => [
                'Dans une ville' => 'dansVille',
                'Par distance d\'une ville' => 'distanceVille'
            ]);

        $distanceChoiceType = array('required' => false,
            'choices' => [
                5 => 5,
                10 => 10,
                20 => 20,
                50 => 50,
                100 => 100
            ]);

        $builder
            ->add('typeInstitute', ChoiceType::class, $typeInstitute)
            ->add('typeCenter', ChoiceType::class, $typeCenter)
            ->add('typeAutre', ChoiceType::class, $typeAutreEtablissement)
            ->add('typeRelance', ChoiceType::class, $relance)
            ->add('dansVilleOuParDistance', ChoiceType::class, $dansVilleOuParDistance)
            ->add('ville', VilleType::class, array('required' => false))
            ->add('geolocalisation', HiddenType::class)
            ->add('distance', ChoiceType::class, $distanceChoiceType);

        $builder->get("ville")->addModelTransformer(new VilleAutocompleteTransformer($this->entityManager));
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'mailing';
    }
}
