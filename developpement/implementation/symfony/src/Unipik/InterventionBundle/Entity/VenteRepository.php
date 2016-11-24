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
     * @param date             $start            Le debut
     * @param date             $end              La fin
     * @param bool             $dateChecked      La date est elle cochée
     * @param string           $field            Le champ de tri
     * @param bool             $desc             Descendant
     * @param string           $ville            La ville
     * @param distance         $distance         La distance
     *
     * @return array
     */
    public function getType($start, $end, $dateChecked, $field, $desc, $user, $ville = null, $distance = null, $geolocalisation = null) {

        $qb = $this->createQueryBuilder('v');

        $this->_getVentes($qb, $start, $end, $dateChecked);


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

        } else {
            if ($desc) {
                $qb->orderBy('v.dateVente', 'DESC');
            } else {
                $qb->orderBy('v.dateVente', 'ASC');
            }
        }

        if ($distance) {
            if ($ville) {
                $this->_withinXkmVille($qb, $geolocalisation, $distance);
            }
            else {
                $this->_withinXkmDomicile($qb, $user, $distance);
            }
        }
        else {
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
     *
     * @return QueryBuilder
     */
    private function _getVentes(QueryBuilder $qb, $start,  $end , $datesChecked) {
        if (!$datesChecked) {
            $this->_whereInterventionsBetweenDates($start, $end, $qb);
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
            ->andWhere('i.dateVente BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end);
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
     * @param QueryBuilder $qb                 Le querybuilder
     * @param string       $geolocalisation    La géolocalisation de la ville
     * @param string       $distance           La distance
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


}
