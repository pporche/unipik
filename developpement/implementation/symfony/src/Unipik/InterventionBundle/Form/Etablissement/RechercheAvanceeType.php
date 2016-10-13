<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 19/09/16
 * Time: 12:06
 */

namespace Unipik\InterventionBundle\Form\Etablissement;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\VilleAutocompleteTransformer;


class RechercheAvanceeType  extends AbstractType
{
    private $entityManager;

    /**
     * VilleType constructor.
     * @param ObjectManager $entityManager
     */
    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * form builder
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
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




        $builder
            ->add('typeEtablissement',ChoiceType::class, $optionChoiceType)
            ->add('typeEnseignement', ChoiceType::class, $optionEnseignementType)
            ->add('typeCentre', ChoiceType::class, $optionCentreType)
            ->add('typeAutreEtablissement', ChoiceType::class, $optionAutreEtablissementType)
            ->add('ville', TextType::class, array('required' => false))
        ;

        $builder->get("ville")->addModelTransformer(new VilleAutocompleteTransformer($this->entityManager));
    }

}
