<?php
/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 09/11/16
 * Time: 12:07
 */

namespace Unipik\MailBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MailTaskRepository extends EntityRepository {

    public function getLastMailTask() {
        return $this->createQueryBuilder('mt')
            ->orderBy('mt.date_insert', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}