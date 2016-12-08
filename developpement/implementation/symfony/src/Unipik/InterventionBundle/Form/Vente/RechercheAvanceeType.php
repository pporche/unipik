<?php
/**
 * Created by PhpStorm.
 * User: Melissa
 * Date: 24/11/16
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

namespace Unipik\InterventionBundle\Form\Vente;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Unipik\ArchitectureBundle\Form\Adresse\CodePostalType;
use Unipik\ArchitectureBundle\Form\Adresse\VilleType;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\VilleAutocompleteTransformer;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

/**
 * Le type recherche avancee
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class RechercheAvanceeType extends AbstractType
{
    private $entityManager;

    /**
     * VilleType constructor.
     *
     * @param ObjectManager $entityManager Le manager
     */
    public function __construct(ObjectManager $entityManager)
    {
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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

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

        $builder
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
            ->add('ville', VilleType::class, array('required' => false, 'attr' => ['maxlength' => '500']))
            ->add('codePostal', CodePostalType::class)
            ->add('geolocalisation', HiddenType::class)
            ->add('distance', ChoiceType::class, $distanceChoiceType)
            ->add('CADebut', NumberType::class, array('required' => false, 'attr' => ['maxlength' => '10']))
            ->add(
                'CAFin', NumberType::class, array('required' => false, 'attr' => ['maxlength' => '5'])
            );

        $builder->get("ville")->addModelTransformer(new VilleAutocompleteTransformer($this->entityManager));
    }

}
