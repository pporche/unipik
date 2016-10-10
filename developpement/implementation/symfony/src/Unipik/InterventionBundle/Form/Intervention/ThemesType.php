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
        $optionChoiceType = array( 'label' => false, 'attr' => ['class' => 'form-theme-pld'],
            'choices' => [
                "Le milléniare pour le développement" => 'millenaire pour le developpement',
                "Le rôle de l Unicef" => 'role de l Unicef',
                "Convention internationale des Droits de l'Enfant" => 'convention internationale des droits de l enfant',
                "L'éducation" => 'education',
                "La santé (en général)" => 'sante en generale',
                "La santé - Alimentation" => 'sante et alimentation',
                "L'eau" => 'eau',
                "Les urgences mondiales" => 'urgences mondiales',
                "Le harcèlement" => 'harcelement',
                "Le travail des enfants" => 'travail des enfants',
                "Les enfants soldats" => 'enfants et soldats',
                "VIH et sida" => 'VIH et sida'
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
