<?php
/**
 * Created by PhpStorm.
 * User: Kafui
 * Date: 13/09/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\InterventionBundle\Form\Intervention;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Unipik\ArchitectureBundle\Form\AbstractFieldsetType;
use Unipik\UserBundle\Form\DataTransformer\BenevoleTransformer;

/**
 * Le type attribution
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class AttributionType extends AbstractFieldsetType {
    private $entityManager;

    /**
     * AdresseType constructor.
     *
     * @param ObjectManager $entityManager Le manager
     */
    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('idIntervention', HiddenType::class)
            ->add('benevole', TextType::class);

        $builder->get("benevole")->addModelTransformer(new BenevoleTransformer($this->entityManager));
    }

    /**
     * {@inheritdoc}
     * Renvoie attribution
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'attribution';
    }
}
