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

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;
use Unipik\InterventionBundle\Form\Intervention\MaterielFrimousseType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Unipik\ArchitectureBundle\Form\NiveauThemeType;

/**
 * Le type intervention template
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class InterventionTemplateType extends AbstractFieldsetType {


    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options){

        $generalType = array('required' => true,
            'label' => 'Type d\'Intervention*',
            'attr' => ['class' => 'form-type-intervention'],
            'choices' => [
                'Action éducative' => 'pld',
                'Frimousse' => 'frim',
                'Autre' => 'aut'
            ],);

        $builder
            ->add('TypeGeneral', ChoiceType::class, $generalType)
            ->add('materielDispoPlaidoyer', MaterielType::class, array('label' => 'Matériel disponible'))
            ->add('materiauxFrimousse', MaterielFrimousseType::class, array('label' => 'Matériel diponible'))
            ->add('nbPersonne', IntegerType::class, array('label' => 'Nb de participants*'))
            ->add('niveauTheme', NiveauThemeType::class, array('label' => false))
            ->add('remarques', TextareaType::class, array('label' => 'Remarques', 'attr'=> ['class' => 'form-remarques', 'rows' => '5', 'maxlength' => '500'], 'required' => false));
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
