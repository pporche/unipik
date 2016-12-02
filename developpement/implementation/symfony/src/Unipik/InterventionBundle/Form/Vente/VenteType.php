<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 16/11/16
 * Time: 18:10
 *
 * PHP version 5
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\InterventionBundle\Form\Vente;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * Class VenteType
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class VenteType extends AbstractType
{
    /**
     * Le formbuilder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('chiffreAffaire', MoneyType::class)
            ->add(
                'dateVente', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy'
                )
            )
            ->add('remarques', TextareaType::class, array('attr'=> ['rows' => '5', 'maxlength' => '500'], 'required' => false));
    }

    /**
     * Configuration des options
     *
     * @param OptionsResolver $resolver le resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
            'data_class' => 'Unipik\InterventionBundle\Entity\Vente'
            )
        );
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'unipik_interventionbundle_vente';
    }


}
