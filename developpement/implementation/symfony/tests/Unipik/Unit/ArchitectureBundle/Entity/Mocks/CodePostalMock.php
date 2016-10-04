<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/10/16
 * Time: 18:35
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\Mock;
use Unipik\ArchitectureBundle\Entity\CodePostal;

class CodePostalMock extends Mock {

    /**
     * @return CodePostal
     */
    public static function create() {
        $cp = new CodePostal();

        $cp->setCode("76000")
        ;

        return $cp;
    }

    /**
     * @param $nb
     * @return CodePostal[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
