<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 14/11/16
 * Time: 16:30
 *
 * PHP version 5
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Moment hebdomadaire Repository
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class MomentHebdomadaireRepository  extends EntityRepository {

    /**
     * Get by day and moment
     *
     * @param string $day    Le jour
     * @param string $moment Le moment
     *
     * @return mixed
     *
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
