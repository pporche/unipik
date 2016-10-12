<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 09/09/16
 * Time: 16:55
 */

namespace Unipik\InterventionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class InterventionRepository extends EntityRepository {

    /**
     * Generic function for DB queries.
     *
     * @param $start
     * @param $end
     * @param $dateChecked
     * @param $typeIntervention
     * @param $field
     * @param $desc
     * @param $statut
     * @param $user
     * @return array
     */
    public function getType($start, $end, $dateChecked, $typeIntervention, $field, $desc, $statut, $user = null){
        switch ($typeIntervention) {
            case "plaidoyer":
                $qb = $this->getPlaidoyers($start, $end, $dateChecked);
                break;
            case "frimousse":
                $qb = $this->getFrimousses($start, $end, $dateChecked);
                break;
            case "autreIntervention":
                $qb = $this->getAutresInterventions($start, $end, $dateChecked);
                break;
            default:
                $qb = $this->getToutesInterventions($start, $end, $dateChecked);
                break;
        }

        switch ($statut) {
            case "attribuees":
                $this->getInterventionsAttribuees($qb);
                break;
            case "nonAttribuees":
                $this->getInterventionsNonAttribuees($qb);
                break;
            case "realisees":
                $this->getInterventionsRealisees($qb);
                break;
            default:
                break;
        }

        if ($user) {
            $qb->andWhere('i.benevole = :user')
                ->setParameter('user', $user);
        }





        if($field=="lieu"){
            if($desc){
                $qb
                    ->from('Unipik\InterventionBundle\Entity\Etablissement','e')
                    ->andWhere('i.etablissement = e')
                    ->from('Unipik\ArchitectureBundle\Entity\Adresse','a')
                    ->andWhere('e.adresse = a')
                    ->from('\Unipik\ArchitectureBundle\Entity\Ville','v')
                    ->andWhere('a.ville = v')
                    ->orderBy('v.nom','DESC');
            }else{
                $qb
                    ->from('Unipik\InterventionBundle\Entity\Etablissement','e')
                    ->andWhere('i.etablissement = e')
                    ->from('Unipik\ArchitectureBundle\Entity\Adresse','a')
                    ->andWhere('e.adresse = a')
                    ->from('\Unipik\ArchitectureBundle\Entity\Ville','v')
                    ->andWhere('a.ville = v')
                    ->orderBy('v.nom','ASC');
            }

        }else{
            if($desc){
                $qb->orderBy('i.dateIntervention','DESC');
            }else{
                $qb->orderBy('i.dateIntervention','ASC');
            }
        }

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * Get Frimousses
     *
     * @param $start
     * @param $end
     * @param $datesChecked
     * @return QueryBuilder
     *
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

        return $qb;
    }

    /**
     * Get Plaidoyers
     *
     * @param $start
     * @param $end
     * @param $datesChecked
     * @return QueryBuilder
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

        return $qb;
    }

    /**
     * Get Autres Interventions
     * @param $start
     * @param $end
     * @param $datesChecked
     * @return QueryBuilder
     */
    public function getAutresInterventions($start,  $end , $datesChecked) {
        $qb = $this->createQueryBuilder('i');

        $qb
            ->where($qb->expr()->isNotNull('i.description'))
        ;

        if(!$datesChecked) {
            $this->whereInterventionsBetweenDates($start,$end,$qb);
        }

        return $qb;
    }


    /**
     *  Get Toutes Interventions
     * @param $start
     * @param $end
     * @param $datesChecked
     * @return QueryBuilder
     */
    public function getToutesInterventions($start,  $end , $datesChecked) {
        $qb = $this->createQueryBuilder('i');

        if(!$datesChecked) {
            $this->whereInterventionsBetweenDates($start,$end,$qb);
        }

        return $qb;
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
     * Get Interventions réalisées ou non réalisées d'un bénévole
     *
     * @param boolean $realisees
     *@param \Unipik\UserBundle\Entity\Benevole $benevole
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterventionsRealiseesOuNonBenevole($benevole, $realisees) {
        $query = $this->_em->createQuery('SELECT i FROM InterventionBundle:Intervention i  JOIN i.benevole b  WHERE i.realisee = :r AND b.id = :id ORDER BY i.dateIntervention ASC');
        $query->setParameter('r',$realisees);
        $query->setParameter('id',$benevole->getId());

        return new ArrayCollection($query->getResult());
    }

    /**
     * Get Interventions réalisées ou non réalisées d'un bénévole
     *
     * @param boolean $realisees
     * @param \Unipik\UserBundle\Entity\Benevole $benevole
     * @param int $maxResults
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNInterventionsRealiseesOuNonBenevole($benevole, $realisees, $maxResults) {
        $query = $this->_em->createQuery('SELECT i FROM InterventionBundle:Intervention i JOIN i.benevole b WHERE i.realisee = :r AND b.id = :id ORDER BY i.dateIntervention ASC');
        $query->setParameter('r',$realisees);
        $query->setParameter('id',$benevole->getId());
        $query->setMaxResults($maxResults);
        return new ArrayCollection($query->getResult());
    }

    /**
     * Where Interventions between dates
     *
     * @param \DateTime $start
     * @param \DateTime $end
     *
     */
    public function whereInterventionsBetweenDates($start, $end, QueryBuilder $qb) {
        $qb
            ->andWhere('i.dateIntervention BETWEEN :start AND :end')
            ->setParameter('start',$start)
            ->setParameter('end',$end);
    }

    /**
     * @param QueryBuilder $qb
     */
    public function getInterventionsAttribuees(QueryBuilder $qb){
        $qb
            ->andWhere($qb->expr()->isNotNull('i.benevole'))
            ->andWhere($qb->expr()->eq('i.realisee', $qb->expr()->literal(false)));
    }

    /**
     * @param QueryBuilder $qb
     */
    public function getInterventionsNonAttribuees(QueryBuilder $qb){
        $qb
            ->andWhere($qb->expr()->isNull('i.benevole'));
    }

    /**
     * @param QueryBuilder $qb
     */
    public function getInterventionsRealisees(QueryBuilder $qb){
        $qb
            ->andWhere($qb->expr()->isNotNull('i.benevole'))
            ->andWhere($qb->expr()->eq('i.realisee', $qb->expr()->literal(true)));
    }
}
