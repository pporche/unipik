<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 27/04/16
 * Time: 09:09
 */

namespace Unipik\UserBundle\Form\Adresse;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class CodePostalType
 * @package Unipik\UserBundle\Form\Adresse
 */
class CodePostalType extends AbstractType {

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
        return 'codePostal';
    }
}
