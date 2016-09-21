<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 19/09/16
 * Time: 12:06
 */

namespace Unipik\InterventionBundle\Form\Etablissement;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;


class RechercheAvanceeType  extends AbstractType
{

//    public function createArrayOfTown(){
//        $lines = file(__DIR__ ."/../../../../../../ressourcesNettoyees/communesFrance.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
//        $result = [];
//        foreach($lines as $l){
//            $result[$l] = $l;
//        }
//        var_dump($result);
//        return $result;
//    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

//        $villes = $this->createArrayOfTown();

        $optionChoiceType = array( 'expanded' => true, 'multiple' => false, 'mapped' => false, 'required' => false,
            'choices' => [
                'Tous' => '',
                'Enseignements' => 'enseignement',
                'Centres de Loisirs' => 'centre',
                'Autres établissements' => 'autreEtablissement'
            ],);

        $optionEnseignementType = array( 'expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'Maternelle' => 'maternelle',
                'Elémentaire' => 'elementaire',
                'Collège' => 'college',
                'Lycée' => 'lycee',
                'Supérieur' => 'superieur'
            ],);

        $optionCentreType = array( 'expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'Maternelle' => 'maternelle',
                'Elémentaire' => 'elementaire',
                'Adolescent' => 'adolescent',
                'Autre' => 'autre'
            ],);

        $optionAutreEtablissementType = array( 'expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'Mairie' => 'mairie',
                'Maison de retraite' => 'maisonRetraite',
                'Autre' => 'autre'
            ],);


        $optionVille = array( 'expanded' => false, 'multiple' => false, 'mapped' => false, 'required' => false,
            'choices' =>[
                'Mairie' => 'mairie',
                'Maison de retraite' => 'maisonRetraite',
                'Autre' => 'autre'
            ]);

        $builder
            ->add('typeEtablissement',ChoiceType::class, $optionChoiceType)
            ->add('typeEnseignement', ChoiceType::class, $optionEnseignementType)
            ->add('typeCentre', ChoiceType::class, $optionCentreType)
            ->add('typeAutreEtablissement', ChoiceType::class, $optionAutreEtablissementType)
            ->add('ville', ChoiceType::class, $optionVille)
        ;
    }

}
