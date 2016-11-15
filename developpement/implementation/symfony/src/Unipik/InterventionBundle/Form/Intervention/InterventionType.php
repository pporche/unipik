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


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;
use Unipik\ArchitectureBundle\Form\NiveauThemeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Le type intervention
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class InterventionType extends AbstractFieldsetType {

    /**
     * Le formbuilder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $choiceClasse = array('required' => false, 'label' => 'Année scolaire', 'attr' => ['class' => 'form-annee-scolaire'],
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

        $builder
            ->add(
                'dateIntervention', DateType::class, array(
                'widget' => 'single_text',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => true,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd-MM-yyyy',
                'required' => false
                )
            )
            ->add('lieu', TextType::class,array('required' => false))
            ->add('materielDispoPlaidoyer', MaterielType::class, array('label' => 'Matériel'))
            ->add('materiauxFrimousse', MaterielFrimousseType::class, array('label' => 'Matériel frimousse'))
            ->add('nbPersonne', IntegerType::class, array('label' => 'Participants'))
            ->add('niveauTheme', NiveauThemeType::class)
            ->add('niveau', ChoiceType::class, $choiceClasse)
            ->add(
                'heure', TimeType::class, array(
                //                'input'  => 'string',
                'widget' => 'choice',
                )
            )
            ->add('description',TextareaType::class,array('required' => false));
    }

    /**
     * {@inheritdoc}
     * Renvoie intervention
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'intervention';
    }
}
