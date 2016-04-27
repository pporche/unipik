<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 26/04/16
 * Time: 08:35
 */

namespace Unipik\ArchitectureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DemandeInterventionType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('ville_etablissement', VilleType::class, array('label' => 'Ville de l\'établissement'))
            ->add('nom', TextType::class)
        ;
    }


    public function getBlockPrefix() {
        return 'demande_intervention';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
