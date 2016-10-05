<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/10/16
 * Time: 18:35
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Proxies\__CG__\Unipik\ArchitectureBundle\Entity\Departement;
use Tests\Unipik\Unit\Utils\Mock;
use Unipik\ArchitectureBundle\Entity\CodePostal;

class CodePostalMock extends Mock {

    /**
     * @return CodePostal
     */
    public static function create() {
        $cp = new CodePostal();
        $d = DepartementMock::create();

        $cp
            ->setCode("76000")
            ->setDepartement($d)
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
