<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 19/04/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Le repository qui gère les etablissements
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class EtablissementRepository extends EntityRepository {

    /**
     * Generic function for DB queries.
     *
     * @param string $typeEtablissement Le type d'etablissement
     * @param string $typeEnseignement  Le type en cas d'enseignement
     * @param string $typeCentre        Le type en cas de centre
     * @param string $typeAutre         Le type en cas d'autre
     * @param string $ville             La ville
     * @param string $field             Le champs
     * @param bool   $desc              Descendant ou non
     *
     * @return array
     */
    public function getType($typeEtablissement, $typeEnseignement, $typeCentre, $typeAutre,  $ville, $field, $desc){
        switch ($typeEtablissement) {
        case "enseignement":
            $results = $this->_getEnseignementsByType($typeEnseignement, $ville, $field, $desc);
            break;
        case "centre":
            $results = $this->_getCentresLoisirsByType($typeCentre, $ville, $field, $desc);
            break;
        case "autreEtablissement":
            $results = $this->_getAutresEtablissementsByType($typeAutre, $ville, $field, $desc);
            break;
        default:
            $results = $this->_getTousEtablissements($ville, $field, $desc);
            break;
        }



        return $results
            ;
    }


    /**
     * Get Enseignements by Type
     *
     * @param string $typeEnseignement Le type
     * @param string $ville            La ville
     * @param string $field            Le champs
     * @param string $desc             Descendant ou non
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    private function _getEnseignementsByType($typeEnseignement, $ville = null, $field = null, $desc = null) {
        $results = array();
        foreach ($typeEnseignement as $te) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeEnseignement = :typeE');

            if ($ville) {
                $this->_whereVilleIs($qb, $ville);
            }

            if ($field=="nom") {
                if ($desc) {
                    $qb->orderBy('e.nom', 'DESC');
                } else {
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
     * @param string $typeCentre Le type de centre
     * @param string $ville      La ville
     * @param string $field      Le champs
     * @param string $desc       Descendant ou non
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    private function _getCentresLoisirsByType($typeCentre, $ville = null, $field = null , $desc = null) {
        $results = array();
        foreach ($typeCentre as $tc) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeCentre = :typeC');

            if ($ville) {
                $this->_whereVilleIs($qb, $ville);
            }

            if ($field=="nom") {
                if ($desc) {
                    $qb->orderBy('e.nom', 'DESC');
                } else {
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
     * @param string $typeAutreEtablissement Le type de autre
     * @param string $ville                  La ville
     * @param string $field                  Le champs
     * @param bool   $desc                   Descendant ou non
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    private function _getAutresEtablissementsByType($typeAutreEtablissement, $ville = null, $field = null , $desc = null ) {
        $results = array();
        foreach ($typeAutreEtablissement as $tae) {
            $qb = $this->createQueryBuilder('e');
            $qb
                ->where('e.typeAutreEtablissement = :typeAE');

            if ($ville) {
                $this->_whereVilleIs($qb, $ville);
            }

            if ($field=="nom") {
                if ($desc) {
                    $qb->orderBy('e.nom', 'DESC');
                } else {
                    $qb->orderBy('e.nom', 'ASC');
                }
            }

            $qb ->setParameter('typeAE', $tae);

            $results = array_merge($results, $qb->getQuery()->getResult());
        }
        return $results;
    }


    /**
     * Get tous etablissements
     *
     * @param string $ville La ville
     * @param string $field Le champs
     * @param bool   $desc  Descendant ou non
     *
     * @return array
     */
    private function _getTousEtablissements($ville, $field, $desc) {
        $qb = $this->createQueryBuilder('e');

        if ($ville) {
            $this->_whereVilleIs($qb, $ville);
        }

        if ($field=="nom") {
            if ($desc) {
                $qb->orderBy('e.nom', 'DESC');
            } else {
                $qb->orderBy('e.nom', 'ASC');
            }
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Where ville is
     *
     * @param QueryBuilder $qb    Le querybuilder
     * @param string       $ville La ville
     *
     * @return object
     */
    private function _whereVilleIs(QueryBuilder $qb, $ville) {
        $qb
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
            ->andWhere('e.adresse = a')
            ->andWhere('a.ville = :ville')
            ->setParameter('ville', $ville);
    }
}
