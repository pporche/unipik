<?php
/**
 * Created by PhpStorm.
 * User: melissa
 * Date: 23/11/16
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
 * Le repository qui gère les ventes
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class VenteRepository extends EntityRepository {

    /**
     * Generic function for DB queries.
     *
     * @param date          $start           Le debut
     * @param date          $end             La fin
     * @param bool          $dateChecked     La date est elle cochée
     * @param string        $field           Le champ de tri
     * @param bool          $desc            Descendant
     * @param user          $user            L'utilisateur
     * @param string        $ville           La ville
     * @param distance      $distance        La distance
     * @param geoloc        $geolocalisation La geolocalisation
     * @param etablissement $etablissement   L'établissement qui fait la vente
     * @param intervention  $intervention    L'intervention liée à la vente
     * @param int           $borne1          La borne min
     * @param int           $borne2          La borne max
     *
     * @return array
     */
    public function getType($start, $end, $dateChecked, $field, $desc, $user, $ville = null, $distance = null, $geolocalisation = null, $etablissement = null, $intervention = null, $borne1 = null, $borne2 = null) {

        $qb = $this->createQueryBuilder('v');

        $this->_getVentes($qb, $start, $end, $dateChecked, $borne1, $borne2);


        if ($etablissement != null) {
            $qb
                ->andWhere('v.etablissement = :etablissement')
                ->setParameter('etablissement', $etablissement);
        }

        if ($intervention != null) {
            $qb
                ->andWhere('v.intervention = :intervention')
                ->setParameter('intervention', $intervention);
        }


        if ($field=="lieu") {
            if ($desc) {
                $qb
                    ->from('Unipik\InterventionBundle\Entity\Etablissement', 'et')
                    ->andWhere('v.etablissement = et')
                    ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'ad')
                    ->andWhere('et.adresse = ad')
                    ->from('\Unipik\ArchitectureBundle\Entity\Ville', 'vi')
                    ->andWhere('ad.ville = vi')
                    ->orderBy('vi.nom', 'DESC');
            } else {
                $qb
                    ->from('Unipik\InterventionBundle\Entity\Etablissement', 'et')
                    ->andWhere('v.etablissement = et')
                    ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'ad')
                    ->andWhere('et.adresse = ad')
                    ->from('\Unipik\ArchitectureBundle\Entity\Ville', 'vi')
                    ->andWhere('ad.ville = vi')
                    ->orderBy('vi.nom', 'ASC');
            }

        } else if ($field=="dateVente") {
            if ($desc) {
                $qb->orderBy('v.dateVente', 'DESC');
            } else {
                $qb->orderBy('v.dateVente', 'ASC');
            }
        } else {
            if ($desc) {
                $qb->orderBy('v.chiffreAffaire', 'DESC');
            } else {
                $qb->orderBy('v.chiffreAffaire', 'ASC');
            }
        }

        if ($distance) {
            if ($ville) {
                $this->_withinXkmVille($qb, $geolocalisation, $distance);
            } else {
                $this->_withinXkmDomicile($qb, $user, $distance);
            }
        } else {
            if ($ville) {
                $this->_whereVilleIs($qb, $ville);
            }
        }

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * Get Vente
     *
     * @param QueryBuilder $qb           Le QueryBuilder
     * @param date         $start        La date de debut
     * @param date         $end          La date de fin
     * @param bool         $datesChecked La date est cochee
     * @param int          $borne1       La borne min
     * @param int          $borne2       La borne max
     *
     * @return QueryBuilder
     */
    private function _getVentes(QueryBuilder $qb, $start,  $end , $datesChecked, $borne1, $borne2) {

        if (!$datesChecked) {
            $this->_whereInterventionsBetweenDates($start, $end, $qb);
        }

        if ($borne1!=null && $borne2!=null) {
            $this->_whereVentesBetweenPrix($borne1, $borne2, $qb);
        }
    }

    /**
     * Where Ventes between dates
     *
     * @param \DateTime    $start Le debut
     * @param \DateTime    $end   La fin
     * @param QueryBuilder $qb    Le querybuilder
     *
     * @return object
     */
    private function _whereInterventionsBetweenDates($start, $end, QueryBuilder $qb) {
        $qb
            ->andWhere('v.dateVente BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end);

    }

    /**
     * Where Ventes between two prices
     *
     * @param Double       $borne1 Le debut
     * @param Double       $borne2 La fin
     * @param QueryBuilder $qb     Le querybuilder
     *
     * @return object
     */
    private function _whereVentesBetweenPrix($borne1, $borne2, QueryBuilder $qb) {
        $qb
            ->andWhere('v.chiffreAffaire BETWEEN :borne1 AND :borne2')
            ->setParameter('borne1', $borne1)
            ->setParameter('borne2', $borne2);

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
            ->from('Unipik\InterventionBundle\Entity\Etablissement', 'e')
            ->andWhere('v.etablissement = e')
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
            ->andWhere('e.adresse = a')
            ->andWhere('a.ville = :ville')
            ->setParameter('ville', $ville);
    }

    /**
     * Verifie si un point est dans une distance d'une ville
     *
     * @param QueryBuilder $qb              Le querybuilder
     * @param string       $geolocalisation La géolocalisation de la ville
     * @param string       $distance        La distance
     *
     * @return void
     */
    private function _withinXkmVille(QueryBuilder $qb, $geolocalisation, $distance) {
        $qb
            ->from('Unipik\InterventionBundle\Entity\Etablissement', 'e')
            ->andWhere('v.etablissement = e')
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
            ->andWhere('e.adresse = a')
            ->andWhere(
                $qb->expr()->eq(
                    sprintf("STDWithin(a.geolocalisation, :geolocalisation, :distance)"),
                    $qb->expr()->literal(true)
                )
            )
            ->setParameter('geolocalisation', $geolocalisation)
            ->setParameter('distance', $distance*1000);
    }

    /**
     * Verifie si un point est dans une distance du domicile
     *
     * @param QueryBuilder $qb       Le querybuilder
     * @param user         $user     L'utilisateur
     * @param distance     $distance La distance
     *
     * @return void
     */
    private function _withinXkmDomicile(QueryBuilder $qb, $user, $distance) {
        $qb
            ->from('Unipik\UserBundle\Entity\Benevole', 'b')
            ->andWhere('b = :user')
            ->setParameter('user', $user)
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'adresse')
            ->andWhere('b.adresse = adresse')
            ->from('Unipik\InterventionBundle\Entity\Etablissement', 'e')
            ->andWhere('v.etablissement = e')
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
            ->andWhere('e.adresse = a')
            ->andWhere(
                $qb->expr()->eq(
                    sprintf("STDWithin(a.geolocalisation, adresse.geolocalisation, :distance)"),
                    $qb->expr()->literal(true)
                )
            )
            ->setParameter('distance', $distance*1000);
    }



}
