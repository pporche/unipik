<?php

namespace Unipik\ArchitectureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Unipik\InterventionBundle\Form\Intervention\ThemesType;
class NiveauThemeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {


        $choiceClasse = array('required' => false, 'label' => 'Année scolaire', 'attr' => ['class' => 'form-annee-scolaire'],
            'choices' => [
                'Petite Section' => 'petite section',
                'Petite/Moyenne Section' => 'petite-moyenne section',
                'Moyenne Section' => 'moyenne section',
                'Moyenne/Grande Section' => 'moyenne-grande section',
                'Grande Section' => 'grande section',
                'Petite/Moyenne/Grande Section' => 'petite-moyenne-grande section',
                'CP' => 'CP',
                'CP/CE1' => 'CP-CE1',
                'CE1' => 'CE1',
                'CE1/CE2' => 'CE1-CE2',
                'CE2' => 'CE2',
                'CE2/CM1' => 'CE2-CM1',
                'CM1' => 'CM1',
                'CM1/CM2' => 'CM1-CM2',
                'CM2' => 'CM2',
                '6ème' => '6eme',
                '5ème' => '5eme',
                '4ème' => '4eme',
                '3ème' => '3eme',
                '2nde' => '2nde',
                '1ère' => '1ere',
                'Terminale' => 'terminale',
                'L1' => 'L1',
                'L2' => 'L2',
                'L3' => 'L3',
                'M1' => 'M1',
                'M2' => 'M2',
                'Autre' => 'autre'

            ]
        );

        $builder
            ->add('niveau',ChoiceType::class,$choiceClasse)
            ->add('theme',ThemesType::class, array('label' => 'Choix des thèmes'))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unipik\ArchitectureBundle\Entity\NiveauTheme'
        ));
    }
}
