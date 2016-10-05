<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 22/09/16
 * Time: 10:36
 */

namespace Unipik\UserBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\VilleAutocompleteTransformer;

/**
 * Class RechercheAvanceeType
 * @package Unipik\UserBundle\Form
 */
class RechercheAvanceeType extends AbstractType {
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
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $activitesChoiceType = array('expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'Actions pontuelles' => 'actions_ponctuelles',
                'Plaidoyers' => 'plaidoyers',
                'Frimousses' => 'frimousses',
                'Projets' => 'projets',
                'Autres' => 'autre'
            ],);

        $responsabilitesChoiceType = array('expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'Actions pontuelles' => 'actionsPonctuelles',
                'Plaidoyers' => 'plaidoyer',
                'Frimousses' => 'frimousse',
                'Projets' => 'projets',
                'Admin Région' => 'adminRegion'
            ],);

        $builder
            ->add('activitesToutes',CheckboxType::class, array('label' => 'Toutes', 'required' => false))
            ->add('activites', ChoiceType::class, $activitesChoiceType)
            ->add('respoActivitesToutes',CheckboxType::class, array('label' => 'Toutes', 'required' => false))
            ->add('responsabilitesActivites', ChoiceType::class, $responsabilitesChoiceType)
            ->add('ville', TextType::class, array('required' => false));

        $builder->get("ville")->addModelTransformer(new VilleAutocompleteTransformer($this->entityManager));

    }
}
