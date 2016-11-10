<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 26/04/16
 * Time: 08:12
 */

namespace Unipik\ArchitectureBundle\Form\Adresse;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class VilleType
 *
 * @package Unipik\ArchitectureBundle\Form\Adresse
 */
class VilleType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function getParent() {
        return TextType::class;
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'ville';
    }

}
