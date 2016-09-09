<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 09/09/16
 * Time: 16:51
 */

namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\EntityRepository;


class EtablissementRepository extends EntityRepository{

    /**
     * getEnseignements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnseignements(){

    }

    /**
     * getCentreLoisirs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCentresLoisirs(){

    }

    /**
     * getAutresEtablissements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAutresEtablissements(){

    }

}
