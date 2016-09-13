<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 09/09/16
 * Time: 16:55
 */

namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\EntityRepository;


class InterventionRepository extends EntityRepository{

    /**
     * Get Frimousses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrimousses(){
        $qb = $this->createQueryBuilder('i');

        $qb
            ->where($qb->expr()->isNotNull('i.niveauFrimousse'))
            ->andWhere($qb->expr()->isNotNull('i.materiauxFrimousse'))
        ;

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Get Plaidyers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaidoyers(){
        $qb = $this->createQueryBuilder('i');

        $qb
            ->where($qb->expr()->isNotNull('i.niveauTheme'))
            ->andWhere($qb->expr()->isNotNull('i.materielDispoPlaidoyer'))
        ;

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Get Autres Interventions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAutresInterventions(){
        $qb = $this->createQueryBuilder('i');

        $qb
            ->where($qb->expr()->isNotNull('i.description'))
        ;

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Get Interventions d'un bénévole
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterventionsBenevole(\Unipik\UserBundle\Entity\Benevole $benevole){
    }
}
