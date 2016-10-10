<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 06/10/16
 * Time: 16:41
 */

namespace Tests\Unipik\Unit\InterventionBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\Mock;
use Unipik\InterventionBundle\Entity\Vente;

class VenteMock extends Mock {

    /**
     * @return Vente
     */
    public static function create() {
        $v = new Vente();

        $v
            ->setDateVente(new \DateTime('2000-01-01'))
            ->setChiffreAffaire(4.22)
        ;

        return $v;
    }

    /**
     * @param $nb
     * @return Vente[]
     */
    public static function createMultiple($nb){
        return parent::createMultiple($nb);
    }
}
