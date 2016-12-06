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
class MailHistoriqueRepository extends EntityRepository {
<<<<<<< HEAD
    /**
     * @param $startDate
     * @param $endDate
=======

    /**
     * @param $startDate
>>>>>>> 522fbbdf2f2f57edbe40cd1ebbbc9a0aaed2deaf
     * @return array
     */
    public function getType($startDate, $endDate){
        $qb = $this->createQueryBuilder('m');

<<<<<<< HEAD
        $from = new \DateTime($startDate);
        $to   = new \DateTime($endDate);

=======
>>>>>>> 522fbbdf2f2f57edbe40cd1ebbbc9a0aaed2deaf
        return $qb
            ->getQuery()
            ->getResult();
    }
}