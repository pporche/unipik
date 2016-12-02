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

namespace Unipik\InterventionBundle\Form\Intervention;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Unipik\ArchitectureBundle\Form\Adresse\VilleType;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\VilleAutocompleteTransformer;

/**
 * Le type recherche avancee
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class RechercheAvanceeType extends AbstractType {
    private $entityManager;

    /**
     * VilleType constructor.
     *
     * @param ObjectManager $entityManager Le manager
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

        $dansVilleOuParDistance = array('required' => false, 'expanded' => true, 'multiple' => false,
            'placeholder' => 'Aucun',
            'choices' => [
                'Dans une ville' => 'dansVille',
                'Par distance d\'un lieu' => 'distanceLieu'
            ]);

        $villeOuDomicile = array('required' => false, 'expanded' => true, 'multiple' => false,
            'choices' => [
                'Ville' => 'ville',
                'Mon domicile' => 'domicile'
            ]);

        $distanceChoiceType = array('required' => false,
            'choices' => [
                5 => 5,
                10 => 10,
                20 => 20,
                50 => 50,
                100 => 100
            ]);

        $optionChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false, 'required' => false,
            'choices' => [
                'Toutes' => '',
                'Action éducative' => 'plaidoyer',
                'Frimousses' => 'frimousse',
                'Autres interventions' => 'autreIntervention'
            ],);

        $statutChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false, 'required' => false,
            'choices' => [
                'Toutes' => '',
                'Attribuées' => 'attribuees',
                'Non attribuées' => 'nonAttribuees',
                'Réalisées' => 'realisees',
            ],);

        $statutMesInterventionsChoiceType = array('expanded' => true, 'multiple' => false, 'mapped' => false, 'required' => false,
            'choices' => [
                'Toutes' => '',
                'En cours' => 'attribuees',
                'Réalisées' => 'realisees',
            ],);

        $niveauFrimousse = array( 'expanded' => false, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'CP' => 'CP',
                'CP/CE1' => 'CP-CE1',
                'CE1' => 'CE1',
                'CE1/CE2' => 'CE1-CE2',
                'CE2' => 'CE2',
                'CE2/CM1' => 'CE2-CM1',
                'CM1' => 'CM1',
                'CM1/CM2' => 'CM1-CM2',
                'CM2' => 'CM2'
            ],);

        $niveauPlaidoyer = array('expanded' => false, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'Petite Section' => 'petite section',
                'Petite/Moyenne Section' => 'petite-moyenne section',
                'Moyenne Section' => 'moyenne section',
                'Moyenne/Grande Section' => 'moyenne-grande section',
                'Grande Section' => 'grande section',
                'Petite/Moyenne/Grande Section' => 'petite-moyenne-grande section',
                'CP' => 'CP',
                'CP/CE1' => 'CP-CE1',
                'CE1' => 'CE1',
                'CE1/CE2' => 'CE1-CE2',
                'CE2' => 'CE2',
                'CE2/CM1' => 'CE2-CM1',
                'CM1' => 'CM1',
                'CM1/CM2' => 'CM1-CM2',
                'CM2' => 'CM2',
                '6ème' => '6eme',
                '5ème' => '5eme',
                '4ème' => '4eme',
                '3ème' => '3eme',
                '2nde' => '2nde',
                '1ère' => '1ere',
                'Terminale' => 'terminale',
                'L1' => 'L1',
                'L2' => 'L2',
                'L3' => 'L3',
                'M1' => 'M1',
                'M2' => 'M2',
                'Autre' => 'autre'

            ]
        );

        $theme = array('expanded' => false, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' =>[
                //  "Le millénaire pour le développement" => 'millenaire pour le developpement', // ajout ajout plus tard
                //   "Le rôle de l Unicef" => 'role de l Unicef', // ajout plus tard
                "Convention internationale des Droits de l'Enfant" => 'convention internationale des droits de l enfant',
                "L'éducation" => 'education',
                "La santé - Alimentation" => 'sante et alimentation',
                "L'eau" => 'eau',
                "Le harcèlement" => 'harcelement',
                "La santé (en général)" => 'sante en generale',
                "Le travail des enfants" => 'travail des enfants',
                "Les enfants soldats" => 'enfants et soldats',
                "Les urgences mondiales" => 'urgences mondiales',
                "VIH et sida" => 'VIH et sida',
            ],);

        $builder
            ->add('typeIntervention', ChoiceType::class, $optionChoiceType)
            ->add('statutIntervention', ChoiceType::class, $statutChoiceType)
            ->add('statutMesInterventions', ChoiceType::Class, $statutMesInterventionsChoiceType)
            ->add('niveauFrimousse', ChoiceType::class, $niveauFrimousse)
            ->add('niveauPlaidoyer', ChoiceType::class, $niveauPlaidoyer)
            ->add('theme', ChoiceType::class, $theme)
            ->add(
                'date', CheckboxType::class, array(
                'label'    => 'Toutes',
                'required' => false,
                )
            )
            ->add(
                'start', DateType::class, array(
                'widget' => 'single_text',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd-MM-yyyy',
                'required' => false
                )
            )
            ->add(
                'end', DateType::class, array(
                'widget' => 'single_text',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd-MM-yyyy',
                'required' => false
                )
            )
            ->add('dansVilleOuParDistance', ChoiceType::class, $dansVilleOuParDistance)
            ->add('villeOuDomicile', ChoiceType::class, $villeOuDomicile)
            ->add('ville', VilleType::class, array('required' => false))
            ->add('geolocalisation', HiddenType::class)
            ->add('distance', ChoiceType::class, $distanceChoiceType);

        $builder->get("ville")->addModelTransformer(new VilleAutocompleteTransformer($this->entityManager));
    }
}
