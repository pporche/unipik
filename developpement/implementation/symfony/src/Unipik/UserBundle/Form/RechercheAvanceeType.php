<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 22/09/16
 * Time: 10:36
 */

namespace Unipik\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class RechercheAvanceeType
 * @package Unipik\UserBundle\Form
 */
class RechercheAvanceeType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $activitesChoiceType = array('expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'Toutes' => '',
                'Actions pontuelles' => 'actionsPonctuelles',
                'Plaidoyers' => 'plaidoyer',
                'Frimousses' => 'frimousse',
                'Projets' => 'projets',
                'Autres' => 'autre'
            ],);

        $responsabilitesChoiceType = array('expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'Toutes' => '',
                'Actions pontuelles' => 'actionsPonctuelles',
                'Plaidoyers' => 'plaidoyer',
                'Frimousses' => 'frimousse',
                'Projets' => 'projets',
                'Admin Région' => 'adminRegion'
            ],);

        $builder
            ->add('activites', ChoiceType::class, $activitesChoiceType)
            ->add('responsabilitesActivites', ChoiceType::class, $activitesChoiceType);

    }
}
