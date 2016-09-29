<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 15:14
 */

namespace Unipik\InterventionBundle\Form\Intervention;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;

class ElevesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $optionTypeEtablissement = array( 'expanded' => true, 'multiple' => false, 'label' => "Type d'établissement",
            'choices' => [
                'Scolaire' => 'scolaire',
                'Centre de loisirs' => 'centreLoisir'
            ],);


        $optionNiveauScolaire = array( 'expanded' => true, 'multiple' => false, 'label' => "Niveau scolaire",
            'choices' => [
                'Maternel' => 'maternelle',
                'Elementaire' => 'elementaire',
                'Collège' => 'college',
                'Lycée' => 'lycee',
                'Supérieur' => 'superieur'
            ],);

        $builder
            ->add('typeEtablissement', ChoiceType::class, $optionTypeEtablissement)
            ->add('niveauScolaire', ChoiceType::class, $optionNiveauScolaire)
            ->add('nbEleves', IntegerType::class, array('label' => "Nombre d'élèves"))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'eleves';
    }
}
