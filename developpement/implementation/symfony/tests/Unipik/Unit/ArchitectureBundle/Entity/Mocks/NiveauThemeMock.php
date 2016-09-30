<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 09:16
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\Mock;
use Unipik\ArchitectureBundle\Entity\NiveauTheme;

class NiveauThemeMock extends Mock {

    public static function create() {
        $r = new NiveauTheme();

        $r
            ->setNiveau("CM1-CM2")
            ->setTheme("convention internationale des droits de l enfant")
        ;

        return $r;
    }
}
