<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 22/09/16
 * Time: 17:48
 */

namespace Tests\Unipik\Unit\UserBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\EntityMock;
use Unipik\UserBundle\Entity\Comite;

class ComiteMock extends EntityMock {

    /**
     * @return Comite
     */
    public static function create() {
        $c = new Comite();

        return $c;
    }

    /**
     * @param $nb
     * @return Comite[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
