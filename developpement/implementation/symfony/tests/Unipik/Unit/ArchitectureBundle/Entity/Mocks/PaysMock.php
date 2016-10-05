<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 21/09/16
 * Time: 08:05
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\Mock;
use Unipik\ArchitectureBundle\Entity\Pays;

class PaysMock extends Mock {

    /**
     * @return Pays
     */
    public static function create() {
        $p = new Pays();

        $p
            ->setNom("France")
        ;

        return $p;
    }

    /**
     * @param $nb
     * @return Pays[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
