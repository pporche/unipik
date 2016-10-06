<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 05/10/16
 * Time: 18:24
 */

namespace Unipik\InterventionBundle\Form\Intervention;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;
use Unipik\UserBundle\Form\DataTransformer\BenevoleTransformer;

class AttributionType extends AbstractFieldsetType {
    private $entityManager;

    /**
     * AdresseType constructor.
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
        $builder
            ->add('idIntervention', HiddenType::class)
            ->add('benevole', TextType::class)
        ;

        $builder->get("benevole")->addModelTransformer(new BenevoleTransformer($this->entityManager));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'attribution';
    }
}
