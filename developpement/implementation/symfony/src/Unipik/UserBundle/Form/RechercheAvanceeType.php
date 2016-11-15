<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 22/09/16
 * Time: 10:36
 *
 * PHP version 5
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
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
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class RechercheAvanceeType extends AbstractType {
    private $entityManager;

    /**
     * VilleType constructor.
     *
     * @param ObjectManager $entityManager Le manager
     *
     * @return object
     */
    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Build a form
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $activitesChoiceType = array('expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'Actions pontuelles' => 'actions_ponctuelles',
                'Plaidoyers' => 'plaidoyers',
                'Actions éducatives' => 'frimousses',
                'Projets' => 'projets',
                'Autres' => 'autre'
            ],);

        $responsabilitesChoiceType = array('expanded' => true, 'multiple' => true, 'mapped' => false, 'required' => false,
            'choices' => [
                'Actions pontuelles' => 'actionsPonctuelles',
                'Actions éducatives' => 'plaidoyer',
                'Frimousses' => 'frimousse',
                'Projets' => 'projets',
                'Admin Région' => 'adminRegion'
            ],);

        $builder
            ->add('activitesToutes', CheckboxType::class, array('label' => 'Toutes', 'required' => false))
            ->add('activites', ChoiceType::class, $activitesChoiceType)
            ->add('respoActivitesToutes', CheckboxType::class, array('label' => 'Toutes', 'required' => false))
            ->add('responsabilitesActivites', ChoiceType::class, $responsabilitesChoiceType)
            ->add('ville', TextType::class, array('required' => false));

        $builder->get("ville")->addModelTransformer(new VilleAutocompleteTransformer($this->entityManager));

    }
}
