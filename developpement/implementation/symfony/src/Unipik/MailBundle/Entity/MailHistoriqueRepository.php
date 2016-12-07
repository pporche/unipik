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

    /**
     * Renvoie le type
     *
     * @param Date $startDate La date de debut
     * @param Date $endDate   La date de fin
     *
     * @return array
     */
    public function getType($startDate, $endDate){
        $qb = $this->createQueryBuilder('m');

        $from = new \DateTime($startDate);
        $to   = new \DateTime($endDate);

        return $qb
            ->getQuery()
            ->getResult();
    }
}