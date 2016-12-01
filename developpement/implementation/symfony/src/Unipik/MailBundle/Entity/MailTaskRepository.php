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