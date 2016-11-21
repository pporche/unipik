<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 19/04/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Le repository qui gère les etablissements
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class EtablissementRepository extends EntityRepository {

    /**
     * Generic function for DB queries.
     *
     * @param string $typeEtablissement Le type d'etablissement
     * @para array $type Le type spécifique (domaines)
     * @param int $ville Id de la ville
     * @param string $field Le champs
     * @param bool $desc Descendant ou non
     *
     * @return array
     */
    public function getType($typeEtablissement, $type, $ville, $field, $desc) {
        $results = array();
        if(!isset($type))
            $type = array("maternelle", "elementaire", "college", "lycee", "superieur", "adolescent", "maison de retraite", "mairie", "autre", "");

        foreach ($type as $t) {
            $qb = $this->createQueryBuilder('e');

            switch ($typeEtablissement) {
                case "enseignement":
                    $qb->where('e.typeEnseignement = :type');
                    break;
                case "centre":
                    $qb->where('e.typeCentre = :type');
                    break;
                case "autreEtablissement":
                    $qb->where('e.typeAutreEtablissement = :type');
                    break;
                default:
                    $qb->where('e.typeEnseignement = :type');
                    $qb->orWhere('e.typeCentre = :type');
                    $qb->orWhere('e.typeAutreEtablissement = :type');
                    break;
            }

            if ($ville) {
                $this->_whereVilleIs($qb, $ville);
            }

            if ($field == "nom") {
                if ($desc) {
                    $qb->orderBy('e.nom', 'DESC');
                } else {
                    $qb->orderBy('e.nom', 'ASC');
                }
            }

            $qb->setParameter('type', $t);

            $results = array_merge($results, $qb->getQuery()->getResult());
        }
        return $results;
    }

    /**
     * Query pour récupérer les établissements n'ayant pas répondu à une demande pour l'année scolaire en cours.
     *
     * @param string $typeEtablissement Le type d'etablissement
     * @param array $type  Le type en cas d'enseignement
     * @param int    $ville             Id de la ville
     *
     * @return array
     */
    public function getTypeAndNoInterventionThisYear($typeEtablissement, $type, $ville) {
        $results = array();
        $dateInf = '01/09/'.date('Y');
        $dateSup = '01/09/'.(date('Y')+1);
        $qbSub = $this->getEntityManager()->createQueryBuilder();
        $sub = $qbSub->select('IDENTITY(i.etablissement)')
            ->from('InterventionBundle:Intervention', 'i')
            ->join('i.demande', 'd')
            ->where('d.dateDemande > :dateInf')
            ->andWhere('d.dateDemande < :dateSup')
            //->andWhere('i.typeIntervention = '.$typeIntervention)
            ->setParameters(array('dateInf' => $dateInf, 'dateSup' => $dateSup))
            ->getQuery()
            ->getResult();
        $subIds = array_map('current', $sub);

        foreach ($type as $t) {
            $qb = $this->createQueryBuilder('e');
            $linked = $qb->select('e.id');

            switch ($typeEtablissement) {
                case "enseignement":
                    $qb->where('e.typeEnseignement = :type');
                    break;
                case "centre":
                    $qb->where('e.typeCentre = :type');
                    break;
                case "autreEtablissement":
                    $qb->where('e.typeAutreEtablissement = :type');
                    break;
                default:
                    $qb->where('e.typeEnseignement = :type');
                    $qb->orWhere('e.typeCentre = :type');
                    $qb->orWhere('e.typeAutreEtablissement = :type');
                    break;
            }

            $qb->andWhere($qb->expr()->notIn('e.id', $subIds));

            if ($ville) {
                $this->_whereVilleIs($linked, $ville);
            }

            $linked->setParameter('type', $t);
            $results = array_merge($results, $linked->getQuery()->getResult());
        }

        return array_map('current', $results);
    }

    /**
     * Where ville is
     *
     * @param QueryBuilder $qb    Le querybuilder
     * @param string       $ville La ville
     *
     * @return object
     */
    private function _whereVilleIs(QueryBuilder $qb, $ville) {
        $qb
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
            ->andWhere('e.adresse = a')
            ->andWhere('a.ville = :ville')
            ->setParameter('ville', $ville);
    }
}
