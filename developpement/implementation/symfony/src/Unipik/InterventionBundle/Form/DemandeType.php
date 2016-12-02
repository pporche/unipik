<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 10/05/16
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
namespace Unipik\InterventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Unipik\UserBundle\Form\ContactType;
use Unipik\InterventionBundle\Form\EtablissementType;
use Unipik\InterventionBundle\Form\Intervention\InterventionTemplateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Unipik\InterventionBundle\Form\Intervention\PlageDateType;
use Unipik\InterventionBundle\Form\Intervention\JourInterventionType;

/**
 * Le type demande
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class DemandeType extends AbstractType {

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
            ->add('Etablissement', EtablissementType::class, array('mapped' => false, 'label' => 'Informations de l\'établissement'))
            ->add('plageDate', PlageDateType::class, array('label' => 'Plage de dates', 'mapped' => false))
            ->add('jour', JourInterventionType::class, array('label' => "Jour de l'intervention", 'mapped' => false))
            ->add(
                'Intervention', CollectionType::class, array('entry_type' => InterventionTemplateType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'mapped' => false
                )
            )
            ->add('Contact', ContactType::class, array('label' => false))
            ->add('Valider_la_demande', SubmitType::class);
    }

    /**
     * Configurer les options
     *
     * @param OptionsResolver $resolver Le resolver
     *
     * @return object
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            array(
              'data_class' => 'Unipik\InterventionBundle\Entity\Demande'
            )
        );
    }

}
