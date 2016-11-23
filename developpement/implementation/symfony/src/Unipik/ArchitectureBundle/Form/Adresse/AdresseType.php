<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 27/04/16
 * Time: 08:31
 *
 * PHP version 5
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\ArchitectureBundle\Form\Adresse;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\F;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\CodePostalAutoCompleteTransformer;
use Unipik\ArchitectureBundle\Form\DataTransformer\Adresse\VilleAutocompleteTransformer;

/**
 * Class AdresseType
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class AdresseType extends AbstractFieldsetType {
    private $entityManager;

    /**
     * AdresseType constructor.
     *
     * @param ObjectManager $entityManager Le manager
     *
     * @return void
     */
    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Le form builder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('adresse', AdType::class)
            ->add('complement', ComplementType::class, array('label' => "Complément","required" => false))
            ->add('ville', VilleType::class, array('required'=>true, 'constraints' => new NotBlank()))
            ->add('codePostal', CodePostalType::class, array('constraints' => new NotBlank()))
            ->add('geolocalisation', HiddenType::class, array("required" => false));

        $builder->get("ville")->addModelTransformer(new VilleAutocompleteTransformer($this->entityManager));
        $builder->get("codePostal")->addModelTransformer(new CodePostalAutocompleteTransformer($this->entityManager));
    }

    /**
     * Configurer les options
     *
     * @param OptionsResolver $resolver Le resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver) {
        parent::configureOptions($resolver);

        $resolver->setDefaults(
            array(
            'data_class' => 'Unipik\ArchitectureBundle\Entity\Adresse',
            )
        );

    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'adresse';
    }
}
