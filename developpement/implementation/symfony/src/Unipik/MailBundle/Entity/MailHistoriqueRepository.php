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
    public function getType($startDate, $endDate, $typeEtablissement, $type, $typeMail){
        if (!isset($type)) {
            $type = array("maternelle", "elementaire", "college", "lycee", "superieur", "adolescent", "maison de retraite", "mairie", "autre", "");
        }
        if (!isset($typeMail)) {
            $typeMail = array("parDefaut", "reponse", "nonReponse");
        }

        $results = array();

        foreach ($type as $t) {
            $qb = $this->createQueryBuilder('m');

            $qb->where('(m.date_envoi BETWEEN :start AND :end )')
                ->setParameter('start', $startDate)
                ->setParameter('end', $endDate);

            $qb =$qb ->join('m.etablissement', 'e');

            switch ($typeEtablissement) {
                case "enseignement":
                    $qb->andWhere('e.typeEnseignement = :type');
                    break;
                case "centre":
                    $qb->andWhere('e.typeCentre = :type');
                    break;
                case "autreEtablissement":
                    $qb->andWhere('e.typeAutreEtablissement = :type');
                    break;
                default:
                    $qb->andWhere('e.typeEnseignement = :type');
                    $qb->orWhere('e.typeCentre = :type');
                    $qb->orWhere('e.typeAutreEtablissement = :type');
                    break;
            }
            $qb->setParameter('type', $t);

            $results = array_merge($results, ($qb->getQuery()->getResult()));
        }

        foreach ($results as $index=>$mail) {
            if(!in_array($mail->getTypeEmail(),$typeMail)){
                array_splice($results, $index, 1);
            }
        }

        return $results;
    }

}