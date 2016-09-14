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


    /**
     * Get Enseignements by Type
     *
     * @param $string $typeEnseignement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnseignementsByType($typeEnseignement){
        $query = $this->_em->createQuery('SELECT e FROM InterventionBundle:Etablissement e WHERE e.typeEnseignement = :typeE');
        $query->setParameter('typeE',$typeEnseignement);

        return $query->getResult();
    }


    /**
     * Get Centres Loisirs by Type
     *
     * @param $string $typeCentre
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCentresLoisirsByType($typeCentre){
        $query = $this->_em->createQuery('SELECT e FROM InterventionBundle:Etablissement e WHERE e.typeCentre = :typeC');
        $query->setParameter('typeE',$typeCentre);

        return $query->getResult();
    }


    /**
     * Get Autres Etablissements by Type
     *
     * @param $string $typeAutreEtablissement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAutresEtablissementsByType($typeAutreEtablissement){
        $query = $this->_em->createQuery('SELECT e FROM InterventionBundle:Etablissement e WHERE e.typeAutreEtablissement = :typeAE');
        $query->setParameter('typeAE',$typeAutreEtablissement);

        return $query->getResult();
    }
}
