<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 14/11/16
 * Time: 16:30
 */

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class MomentHebdomadaireRepository  extends EntityRepository {

    /**
     * @param $day
     * @param $moment
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByDayAndMoment($day, $moment) {
        $qb = $this->createQueryBuilder('mh');
        $qb
            -> where('mh.jour = :jour')
            -> setParameter('jour', $day)
            -> andWhere('mh.moment = :moment')
            -> setParameter('moment', $moment);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
