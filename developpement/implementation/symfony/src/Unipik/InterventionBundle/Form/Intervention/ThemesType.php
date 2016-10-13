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
     * form builder
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $optionChoiceType = array( 'label' => false, 'attr' => ['class' => 'form-theme-pld'],
            'choices' => [
              //  "Le millénaire pour le développement" => 'millenaire pour le developpement', // ajout ajout plus tard
             //   "Le rôle de l Unicef" => 'role de l Unicef', // ajout plus tard
                "Convention internationale des Droits de l'Enfant" => 'convention internationale des droits de l enfant',
                "L'éducation" => 'education',
                "La santé - Alimentation" => 'sante et alimentation',
                "L'eau" => 'eau',
                "Le harcèlement" => 'harcelement',
                "La santé (en général)" => 'sante en generale',
                "Le travail des enfants" => 'travail des enfants',
                "Les enfants soldats" => 'enfants et soldats',
                "Les urgences mondiales" => 'urgences mondiales',
                "VIH et sida" => 'VIH et sida',
            ],);

        $builder
            ->add('themes', ChoiceType::class, $optionChoiceType)
        ;
    }

    /**
     * renvoie themes
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'themes';
    }
}
