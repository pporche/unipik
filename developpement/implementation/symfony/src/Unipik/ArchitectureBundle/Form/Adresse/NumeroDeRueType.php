<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 27/04/16
 * Time: 10:31
 */


namespace Unipik\ArchitectureBundle\Form\Adresse;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class NumeroDeRueType
 * @package Unipik\ArchitectureBundle\Form\Adresse
 */
class NumeroDeRueType extends AbstractType {

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
        return 'numeroDeRue';
    }
}
