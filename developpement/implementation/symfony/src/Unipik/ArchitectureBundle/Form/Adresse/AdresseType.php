<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 27/04/16
 * Time: 08:31
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
 * @package Unipik\ArchitectureBundle\Form\Adresse
 */
class AdresseType extends AbstractFieldsetType {
    private $entityManager;

    /**
     * AdresseType constructor.
     *
     * @param ObjectManager $entityManager
     */
    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('adresse', AdType::class)
            ->add('complement', ComplementType::class, array('label' => "Complément","required" => false))
            ->add('ville', VilleType::class)
            ->add('codePostal', CodePostalType::class)
            ->add('geolocalisation', HiddenType::class, array("required" => false));

        $builder->get("ville")->addModelTransformer(new VilleAutocompleteTransformer($this->entityManager));
        $builder->get("codePostal")->addModelTransformer(new CodePostalAutocompleteTransformer($this->entityManager));
    }

    /**
     * @param OptionsResolver $resolver
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
     */
    public function getBlockPrefix() {
        return 'adresse';
    }
}
