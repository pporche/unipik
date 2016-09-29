<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/05/16
 * Time: 15:41
 */

namespace Unipik\InterventionBundle\Form\Intervention;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;

class ThemesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $optionChoiceType = array( 'expanded' => true, 'multiple' => true, 'label' => 'Choix des thèmes',
            'choices' => [
                "Convention internationale des Droits de l'Enfant" => 'droitsEnfant',
                "L'édution" => 'educiton',
                "La santé alimentaire" => 'santeAlimentaire',
                "L'eau" => 'eau',
                "L'harcélement" => 'harcelement'
            ],);

        $builder
            ->add('themes', ChoiceType::class, $optionChoiceType)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'themes';
    }
}
