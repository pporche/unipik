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
     * Get Enseignements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnseignements(){
        $qb = $this->createQueryBuilder('e');

        $qb
            ->where($qb->expr()->isNotNull('e.typeEnseignement'));

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Get Centre Loisirs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCentresLoisirs(){
        $qb = $this->createQueryBuilder('e');

        $qb
            ->where($qb->expr()->isNotNull('e.typeCentre'));

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * Get Autres Etablissements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAutresEtablissements(){
        $qb = $this->createQueryBuilder('e');

        $qb
            ->where($qb->expr()->isNotNull('e.typeAutreEtablissement'));

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

}
