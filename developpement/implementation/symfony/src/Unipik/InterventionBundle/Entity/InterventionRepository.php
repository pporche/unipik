<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 09/09/16
 * Time: 16:55
 */

namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class InterventionRepository extends EntityRepository {

    /**
     * Get Frimousses
     *
     * @param \Datetime $start
     * @param \Datetime $end
     * @param \boolean $datesChecked
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrimousses($start, $end, $datesChecked) {
        $qb = $this->createQueryBuilder('i');

        $qb
            ->where($qb->expr()->isNotNull('i.niveauFrimousse'))
            ->andWhere($qb->expr()->isNotNull('i.materiauxFrimousse'))
        ;

        if(!$datesChecked) {
            $this->whereInterventionsBetweenDates($start,$end,$qb);
        }

        $this->orderByDesc($qb);

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Get Plaidyers
     *
     * @param \Datetime $start
     * @param \Datetime $end
     * @param \boolean $datesChecked
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaidoyers( $start, $end, $datesChecked) {
        $qb = $this->createQueryBuilder('i');

        $qb
            ->where($qb->expr()->isNotNull('i.niveauTheme'))
            ->andWhere($qb->expr()->isNotNull('i.materielDispoPlaidoyer'))
        ;

        if(!$datesChecked) {
            $this->whereInterventionsBetweenDates($start,$end,$qb);
        }

        $this->orderByDesc($qb);

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Get Autres Interventions
     *
     * @param \Datetime $start
     * @param \Datetime $end
     * @param \boolean $datesChecked
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAutresInterventions($start,  $end , $datesChecked) {
        $qb = $this->createQueryBuilder('i');

        $qb
            ->where($qb->expr()->isNotNull('i.description'))
        ;

        if(!$datesChecked) {
            $this->whereInterventionsBetweenDates($start,$end,$qb);
        }

        $this->orderByDesc($qb);

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * Get Toutes Interventions
     *
     * @param \Datetime $start
     * @param \Datetime $end
     * @param \boolean $datesChecked
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getToutesInterventions($start,  $end , $datesChecked) {
        $qb = $this->createQueryBuilder('i');

        if(!$datesChecked) {
            $this->whereInterventionsBetweenDates($start,$end,$qb);
        }

        $this->orderByDesc($qb);

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * Get Interventions d'un bénévole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterventionsBenevole(\Unipik\UserBundle\Entity\Benevole $benevole) {
        $query = $this->_em->createQuery('SELECT i FROM InterventionBundle:Intervention i JOIN i.benevole b WHERE b.id = :id');
        $query->setParameter('id',$benevole->getId());

        return $query->getResult();
    }

    /**
     * Get Interventions réalisées ou non réalisées
     *
     * @param boolean $realisees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterventionsRealiseesOuNon($realisees) {
        $query = $this->_em->createQuery('SELECT i FROM InterventionBundle:Intervention i WHERE i.realisee = :r');
        $query->setParameter('r',$realisees);

        return $query->getResult();
    }

    /**
     * Where Interventions between dates
     *
     * @param \Date $start
     * @param \Date $end
     *
     */
    public function whereInterventionsBetweenDates($start, $end, QueryBuilder $qb) {
        $qb
            ->andWhere('i.date BETWEEN :start AND :end')
            ->setParameter('start',$start)
            ->setParameter('end',$end);
    }


    public function orderByDesc(QueryBuilder $qb){
        $qb
            ->orderBy('i.date','DESC');
    }
}
