<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 27/04/16
 * Time: 10:34
 */

namespace Unipik\ArchitectureBundle\Form\Adresse;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ComplementType
 *
 * @package Unipik\ArchitectureBundle\Form\Adresse
 */
class ComplementType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TextType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'complement';
    }
}
