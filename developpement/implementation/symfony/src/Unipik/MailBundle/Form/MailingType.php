<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 15:14
 */

namespace Unipik\MailBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;

/**
 * Class MailingType
 * @package Unipik\MailBundle\Form
 */
class MailingType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $type = array( 'expanded' => true, 'multiple' => false, 'label' => "Type d'établissement",
            'choices' => [
                'Maternelle' => 'maternelle',
                'Elémentaire' => 'elementaire',
                'Collège' => 'college',
                'Lycée' => 'lycee',
                'Supérieur' => 'superieur'
            ],);

        $builder
            ->add('type', ChoiceType::class, $type)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'mailing';
    }
}
