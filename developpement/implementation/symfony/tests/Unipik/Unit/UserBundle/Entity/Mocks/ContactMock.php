<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 29/09/16
 * Time: 08:25
 */

namespace Tests\Unipik\Unit\UserBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\Mock;
use Unipik\UserBundle\Entity\Contact;

class ContactMock extends Mock {

    /**
     * @return Contact
     */
    public static function create() {
        $c = new Contact();

        $c = new Contact();
        $c
            ->setEmail("contact@bigcorp.eu")
            ->setNom("Dupond")
            ->setTypeContact("enseignant")
        ;

        return $c;
    }

    /**
     * @param $nb
     * @return Contact[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
