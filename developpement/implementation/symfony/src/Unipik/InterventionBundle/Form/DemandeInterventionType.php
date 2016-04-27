<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 26/04/16
 * Time: 08:35
 */

namespace Unipik\InterventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Unipik\UserBundle\Form\Adresse\AdresseType;
use Unipik\UserBundle\Form\Adresse\VilleType;

class DemandeInterventionType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('ville_etablissement', VilleType::class, array('label' => 'Ville de l\'établissement'))
            ->add('nom', TextType::class)
            ->add('adresse', AdresseType::class, array('fieldset' => true, 'legend' => 'Adresse'))
        ;
    }


    public function getBlockPrefix() {
        return 'demande_intervention';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
