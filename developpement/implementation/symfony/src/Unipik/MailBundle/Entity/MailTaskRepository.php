<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 *
 * PHP version 5
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\MailBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class MailTaskRepository
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class MailTaskRepository extends EntityRepository {

    /**
     * @param $startDate
     * @return array
     */
    public function getType($startDate, $endDate){
        $qb = $this->createQueryBuilder('m');

        $from = new \DateTime($startDate." 00:00:00");
        $to   = new \DateTime($endDate." 23:59:59");

        $qb
            ->andWhere('m.date_insert BETWEEN :from AND :to')
            ->setParameter('from', $from )
            ->setParameter('to', $to);

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * Retourne le dernier mail
     *
     * @return mixed
     */
    public function getLastMailTask() {
        return $this->createQueryBuilder('mt')
            ->orderBy('mt.date_insert', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}