<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 09/09/16
 * Time: 16:55
 */

namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\EntityRepository;


class InterventionRepository extends EntityRepository{

    /**
     * getFrimousses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrimousses(){

    }

    /**
     * getPlaidyers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaidoyers(){

    }

    /**
     * getAutresEtablissements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAutresEtablissements(){

    }
}
