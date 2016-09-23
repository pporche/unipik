<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 09:16
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Unipik\ArchitectureBundle\Entity\NiveauTheme;

class NiveauThemeMock {

    public static function create() {
        $r = new NiveauTheme();

        $r
            ->setNiveau("CM1-CM2")
            ->setTheme("convention internationale des droits de l enfant")
        ;

        return $r;
    }
}
