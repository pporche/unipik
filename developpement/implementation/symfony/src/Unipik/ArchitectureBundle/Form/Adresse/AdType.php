<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 27/04/16
 * Time: 09:07
 */

namespace Unipik\ArchitectureBundle\Form\Adresse;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class AdType
 *
 * @package Unipik\UserBundle\Form\Adresse
 */
class AdType extends AbstractType {

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
        return 'adresse';
    }
}
