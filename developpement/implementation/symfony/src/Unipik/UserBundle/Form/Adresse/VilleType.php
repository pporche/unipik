<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 26/04/16
 * Time: 08:12
 */

namespace Unipik\UserBundle\Form\Adresse;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VilleType extends AbstractType {

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
        return 'ville';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}