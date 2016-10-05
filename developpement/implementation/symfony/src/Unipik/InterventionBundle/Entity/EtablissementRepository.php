<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 09/09/16
 * Time: 16:51
 */

namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class EtablissementRepository extends EntityRepository {

    /**
     * Generic function for DB queries.
     *
     * @param $typeEtablissement
     * @param $ville
     * @param $field
     * @param $desc
     * @return array
     */
    public function getType($typeEtablissement, $ville, $field, $desc){
        switch ($typeEtablissement) {
            case "enseignement":
                $qb = $this->getEnseignements();
                break;
            case "centre":
                $qb = $this->getCentresLoisirs();
                break;
            case "autreEtablissement":
                $qb = $this->getAutresEtablissements();
                break;
            default:
                $qb = $this->getTousEtablissements($ville);
                break;
        }

        if($field=="nom"){
            if($desc){
                $qb->orderBy('e.nom','DESC');
            }else{
                $qb->orderBy('e.nom','ASC');
            }
        }

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * Get Enseignements
     *
     * @return QueryBuilder
     *
     */
    public function getEnseignements() {
        $qb = $this->createQueryBuilder('e');

        $qb
            ->where($qb->expr()->isNotNull('e.typeEnseignement'));

        return $qb;
    }

    /**
     *  Get Centre Loisirs
     *
     * @return QueryBuilder
     *
     */
    public function getCentresLoisirs() {
        $qb = $this->createQueryBuilder('e');

        $qb
            ->where($qb->expr()->isNotNull('e.typeCentre'));

        return $qb;
    }

    /**
     * Get Autres Etablissements
     *
     * @return QueryBuilder
     *
     */
    public function getAutresEtablissements() {
        $qb = $this->createQueryBuilder('e');

        $qb
            ->where($qb->expr()->isNotNull('e.typeAutreEtablissement'));

        return $qb;
    }


    /**
     * Get Enseignements by Type
     *
     * @param $string $typeEnseignement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnseignementsByType($typeEnseignement, $ville) {
        $results = array();
        foreach ($typeEnseignement as $te) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeEnseignement = :typeE');

            if($ville){
                $this->whereVilleIs($qb,$ville);
            }

            $qb ->setParameter('typeE',$te);

            $results = array_merge($results,$qb->getQuery()->getResult());
        }
        return $results;
    }


    /**
     * Get Centres Loisirs by Type
     *
     * @param $string $typeCentre
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCentresLoisirsByType($typeCentre, $ville) {
        $results = array();
        foreach ($typeCentre as $tc) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeCentre = :typeC');

            if($ville){
                $this->whereVilleIs($qb,$ville);
            }

            $qb ->setParameter('typeE',$tc);

            $results = array_merge($results,$qb->getQuery()->getResult());
        }
        return $results;
    }


    /**
     * Get Autres Etablissements by Type
     *
     * @param $string $typeAutreEtablissement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAutresEtablissementsByType($typeAutreEtablissement, $ville) {
        $results = array();
        foreach ($typeAutreEtablissement as $tae) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeAutreEtablissement = :typeAE');

            if($ville){
                $this->whereVilleIs($qb,$ville);
            }

            $qb ->setParameter('typeE',$tae);

            $results = array_merge($results,$qb->getQuery()->getResult());
        }
        return $results;
    }

    /** Get Tous Etablissements
     * @param $ville
     * @return array
     */
    public function getTousEtablissements($ville) {
        $qb = $this->createQueryBuilder('e');

        if($ville){
            $this->whereVilleIs($qb,$ville);
        }

        return $qb;
    }

    /**
     * Where ville is
     *
     * @param QueryBuilder $qb
     * @param $ville
     */
    public function whereVilleIs(QueryBuilder $qb, $ville) {
        $qb
            ->from('Unipik\ArchitectureBundle\Entity\Adresse','a')
            ->andWhere('e.adresse = a')
            ->andWhere('a.ville = :ville')
            ->setParameter('ville',$ville);
    }
}
