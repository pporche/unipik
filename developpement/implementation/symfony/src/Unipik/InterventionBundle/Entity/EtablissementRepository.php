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
    public function getType($typeEtablissement, $typeEnseignement, $typeCentre, $typeAutre,  $ville, $field, $desc){
        switch ($typeEtablissement) {
            case "enseignement":
                $results = $this->getEnseignementsByType($typeEnseignement, $ville, $field, $desc);
                break;
            case "centre":
                $results = $this->getCentresLoisirsByType($typeCentre, $ville, $field, $desc);
                break;
            case "autreEtablissement":
                $results = $this->getAutresEtablissementsByType($typeAutre, $ville, $field, $desc);
                break;
            default:
                $results = $this->getTousEtablissements($ville, $field, $desc);
                break;
        }



        return $results
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
    public function getEnseignementsByType($typeEnseignement, $ville, $field, $desc) {
        $results = array();
        foreach ($typeEnseignement as $te) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeEnseignement = :typeE');

            if($ville){
                $this->whereVilleIs($qb,$ville);
            }

            if($field=="nom"){
                if($desc){
                    $qb->orderBy('e.nom','DESC');
                }else{
                    $qb->orderBy('e.nom','ASC');
                }
            }

            $qb ->setParameter('typeE',$te);

            $results = array_merge($results,$qb->getQuery()->getResult());
        }
//        $qb = $this->createQueryBuilder('e');
//
//        for($i = 0; $i < (count($typeEnseignement)-1); $i+=1){
//            $qb
//                ->andWhere('e.typeEnseignement = :typeE');
//
//            if($ville){
//                $this->whereVilleIs($qb,$ville);
//            }
//
//            $qb ->setParameter('typeE',$typeEnseignement[$i]);
//        }


        return $results;
    }


    /**
     * Get Centres Loisirs by Type
     *
     * @param $string $typeCentre
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCentresLoisirsByType($typeCentre, $ville, $field, $desc) {
        $results = array();
        foreach ($typeCentre as $tc) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeCentre = :typeC');

            if($ville){
                $this->whereVilleIs($qb,$ville);
            }

            if($field=="nom"){
                if($desc){
                    $qb->orderBy('e.nom','DESC');
                }else{
                    $qb->orderBy('e.nom','ASC');
                }
            }

            $qb ->setParameter('typeC',$tc);

            $results = array_merge($results,$qb->getQuery()->getResult());
        }

//        $qb = $this->createQueryBuilder('e');
//
//        for($i = 0; $i < (count($typeCentre)-1); $i+=1){
//            $qb
//                ->andWhere('e.typeCentre = :typeC');
//
//            if($ville){
//                $this->whereVilleIs($qb,$ville);
//            }
//
//            $qb ->setParameter('typeC',$typeCentre[$i]);
//        }


        return $results;
    }


    /**
     * Get Autres Etablissements by Type
     *
     * @param $string $typeAutreEtablissement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAutresEtablissementsByType($typeAutreEtablissement, $ville, $field, $desc) {
//        $qb = $this->createQueryBuilder('e');
//
//        for($i = 0; $i < (count($typeAutreEtablissement)-1); $i+=1){
//            $qb
//                ->andWhere('e.typeAutreEtablissement = :typeAE');
//
//            if($ville){
//                $this->whereVilleIs($qb,$ville);
//            }
//
//            $qb ->setParameter('typeAE',$typeAutreEtablissement[$i]);
//        }
////
        $results = array();
        foreach ($typeAutreEtablissement as $tae) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeAutreEtablissement = :typeAE');

            if($ville){
                $this->whereVilleIs($qb,$ville);
            }

            if($field=="nom"){
                if($desc){
                    $qb->orderBy('e.nom','DESC');
                }else{
                    $qb->orderBy('e.nom','ASC');
                }
            }

            $qb ->setParameter('typeAE',$tae);

            $results = array_merge($results,$qb->getQuery()->getResult());
        }
        return $results;
    }


    /**
     * get tous etablissements
     *
     * @param $ville
     * @return array
     */
    public function getTousEtablissements($ville, $field, $desc) {
        $qb = $this->createQueryBuilder('e');

        if($ville){
            $this->whereVilleIs($qb,$ville);
        }

        if($field=="nom"){
            if($desc){
                $qb->orderBy('e.nom','DESC');
            }else{
                $qb->orderBy('e.nom','ASC');
            }
        }

        return $qb->getQuery()->getResult();
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
