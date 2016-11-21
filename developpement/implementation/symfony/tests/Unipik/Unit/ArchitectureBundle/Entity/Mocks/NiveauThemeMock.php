<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 09:16
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\EntityMock;
use Unipik\ArchitectureBundle\Entity\NiveauTheme;

class NiveauThemeMock extends EntityMock
{

    /**
     * @return NiveauTheme
     */
    public static function create()
    {
        $r = new NiveauTheme();

        $r
            ->setNiveau("CM1-CM2")
            ->setTheme("Droits - Education");

        return $r;
    }

    /**
     * @param $nb
     * @return NiveauTheme[]
     */
    public static function createMultiple($nb)
    {
        return parent::createMultiple($nb);
    }
}
