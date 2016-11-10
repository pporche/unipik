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
     * @param  $typeEtablissement
     * @param  $ville
     * @param  $field
     * @param  $desc
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
     * Get Enseignements by Type
     *
     * @param $string $typeEnseignement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    private function getEnseignementsByType($typeEnseignement, $ville = null, $field = null, $desc = null) {
        $results = array();
        foreach ($typeEnseignement as $te) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeEnseignement = :typeE');

            if($ville) {
                $this->whereVilleIs($qb, $ville);
            }

            if($field=="nom") {
                if($desc) {
                    $qb->orderBy('e.nom', 'DESC');
                }else{
                    $qb->orderBy('e.nom', 'ASC');
                }
            }

            $qb ->setParameter('typeE', $te);

            $results = array_merge($results, $qb->getQuery()->getResult());
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
    private function getCentresLoisirsByType($typeCentre, $ville = null, $field = null , $desc = null) {
        $results = array();
        foreach ($typeCentre as $tc) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeCentre = :typeC');

            if($ville) {
                $this->whereVilleIs($qb, $ville);
            }

            if($field=="nom") {
                if($desc) {
                    $qb->orderBy('e.nom', 'DESC');
                }else{
                    $qb->orderBy('e.nom', 'ASC');
                }
            }

            $qb ->setParameter('typeC', $tc);

            $results = array_merge($results, $qb->getQuery()->getResult());
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
    private function getAutresEtablissementsByType($typeAutreEtablissement, $ville = null, $field = null , $desc = null ) {
        $results = array();
        foreach ($typeAutreEtablissement as $tae) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeAutreEtablissement = :typeAE');

            if($ville) {
                $this->whereVilleIs($qb, $ville);
            }

            if($field=="nom") {
                if($desc) {
                    $qb->orderBy('e.nom', 'DESC');
                }else{
                    $qb->orderBy('e.nom', 'ASC');
                }
            }

            $qb ->setParameter('typeAE', $tae);

            $results = array_merge($results, $qb->getQuery()->getResult());
        }
        return $results;
    }


    /**
     * get tous etablissements
     *
     * @param  $ville
     * @return array
     */
    private function getTousEtablissements($ville, $field, $desc) {
        $qb = $this->createQueryBuilder('e');

        if($ville) {
            $this->whereVilleIs($qb, $ville);
        }

        if($field=="nom") {
            if($desc) {
                $qb->orderBy('e.nom', 'DESC');
            }else{
                $qb->orderBy('e.nom', 'ASC');
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
    private function whereVilleIs(QueryBuilder $qb, $ville) {
        $qb
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
            ->andWhere('e.adresse = a')
            ->andWhere('a.ville = :ville')
            ->setParameter('ville', $ville);
    }
}
