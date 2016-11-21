<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 29/09/16
 * Time: 08:25
 */

namespace Tests\Unipik\Unit\UserBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\EntityMock;
use Unipik\UserBundle\Entity\Contact;
use Unipik\UserBundle\Entity\Participe;

class ContactMock extends EntityMock
{

    /**
     * @return Contact
     */
    public static function create()
    {
        $c = new Contact();
        $c
            ->setEmail("contact@bigcorp.eu")
            ->setNom("Dupond")
            ->setTypeContact("enseignant");

        return $c;
    }

    /**
     * @param $nb
     * @return Contact[]
     */
    public static function createMultiple($nb)
    {
        return parent::createMultiple($nb);
    }
}
