<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 15:14
 *
 * PHP version 5
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\MailBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;

/**
 * Class MailingType
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class MailingType extends AbstractType {

    /**
     * Le formbuilder
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $typeInstitute = array( 'expanded' => true, 'multiple' => true, 'label' => "Type d'établissement",
            'choices' => [
                'Maternelle' => 'maternelle',
                'Elémentaire' => 'elementaire',
                'Collège' => 'college',
                'Lycée' => 'lycee',
                'Supérieur' => 'superieur'
            ],);

        $typeCenter = array( 'expanded' => true, 'multiple' => true, 'label' => "Type de centre de loisirs",
            'choices' => [
                'Maternelle' => 'maternelle',
                'Elémentaire' => 'elementaire',
                'Adolescent' => 'college',
                'autre' => 'autre'
            ],);

        $builder
            ->add('typeInstitute', ChoiceType::class, $typeInstitute)
            ->add('typeCenter', ChoiceType::class, $typeCenter);
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getBlockPrefix() {
        return 'mailing';
    }
}
