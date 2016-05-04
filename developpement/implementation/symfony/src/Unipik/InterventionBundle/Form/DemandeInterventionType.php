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
use Unipik\InterventionBundle\Form\Etablissement\PersonneReferenteType;
use Unipik\InterventionBundle\Form\Etablissement\InfoEtablissementType;
use Unipik\InterventionBundle\Form\Intervention\InterventionType;

class DemandeInterventionType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nomEtablissement', InfoEtablissementType::class, array('fieldset' => true, 'legend' => 'Infos établissement'))
            ->add('personneReferente', PersonneReferenteType::class, array('fieldset' => true, 'legend' => 'Personne Référente'))
            ->add('adresse', AdresseType::class, array('fieldset' => true, 'legend' => "Adresse de l'établissement"))
            ->add('intervention', InterventionType::class, array('fieldset' => true, 'legend' => "Intervention"))
            ->add('remarques', RemarquesType::class, array('fieldset' => true, 'legend' => 'Remarques éventuelles'))
        ;
    }


    public function getBlockPrefix() {
        return 'demande_intervention';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
