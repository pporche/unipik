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
     * @param array  $type              Le type spécifique (domaines)
     * @param int    $ville             Id de la ville
     * @param string $field             Le champs
     * @param bool   $desc              Descendant ou non
     * @param geoloc $geolocalisation   La geolocalisation
     * @param int    $distance          La distance
     * @param int    $user              L'utilisateur
     *
     * @return array
     */
    public function getType($typeEtablissement, $type, $ville, $field, $desc, $geolocalisation=null, $distance=null, $user=null) {
        $results = array();
        if (!isset($type)) {
            $type = array("maternelle", "elementaire", "college", "lycee", "superieur", "adolescent", "maison de retraite", "mairie", "autre", "");
        }

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

            if ($distance) {
                if ($ville) {
                    $this->_withinXkmVille($qb, $geolocalisation, $distance);
                } else {
                    $this->_withinXkmDomicile($qb, $user, $distance);
                }
            } else {
                if ($ville) {
                    $this->_whereVilleIs($qb, $ville);
                }
            }

            if ($field == "nom") {
                if ($desc) {
                    $qb->orderBy('e.nom', 'DESC');
                } else {
                    $qb->orderBy('e.nom', 'ASC');
                }
            } else {
                if ($desc) {
                    $qb->from('Unipik\ArchitectureBundle\Entity\Adresse', 'ad')
                        ->andWhere('e.adresse = ad')
                        ->from('Unipik\ArchitectureBundle\Entity\Ville', 'v')
                        ->andWhere('ad.ville = v')
                        ->orderBy('v.nom ', 'DESC');
                } else {
                    $qb->from('Unipik\ArchitectureBundle\Entity\Adresse', 'ad')
                        ->andWhere('e.adresse = ad')
                        ->from('Unipik\ArchitectureBundle\Entity\Ville', 'v')
                        ->andWhere('ad.ville = v')
                        ->orderBy('v.nom ', 'ASC');
                }
            }

            $qb->setParameter('type', $t);

            $results = array_merge($results, $qb->getQuery()->getResult());
        }
        return $results;
    }

    /**
     * Query pour récupérer les établissements n'ayant pas répondu à une demande pour le niveau scolaire en cours.
     *
     * @param string $typeEtablissement Le type d'etablissement
     * @param array  $type              Le type en cas d'enseignement
     * @param array  $typeIntervention  Le type d'intervention
     * @param int    $ville             Id de la ville
     * @param geoloc $geolocalisation   La geolocalisation
     * @param int    $distance          La distance
     *
     * @return array
     */
    public function getTypeAndNoInterventionThisYear($typeEtablissement, $type, $typeIntervention, $ville=null, $geolocalisation=null, $distance=null) {
        $results = array();
        if (!isset($type)) {
            $type = array("maternelle", "elementaire", "college", "lycee", "superieur", "adolescent", "maison de retraite", "mairie", "autre", "");
        }

        $dateInf = '01/09/'.date('Y');
        $dateSup = '01/09/'.(date('Y')+1);
        $qbSub = $this->getEntityManager()->createQueryBuilder();
        $sub = $qbSub->select('IDENTITY(i.etablissement)')
            ->from('InterventionBundle:Intervention', 'i')
            ->join('i.demande', 'd')
            ->where('d.dateDemande > :dateInf')
            ->andWhere('d.dateDemande < :dateSup')
            ->setParameters(array('dateInf' => $dateInf, 'dateSup' => $dateSup));
        if (isset($typeIntervention)) {
            $sub = $sub->andWhere('i.typeIntervention = :typeIntervention')
                ->setParameters(array('dateInf' => $dateInf, 'dateSup' => $dateSup, 'typeIntervention' => $typeIntervention));
        } else {
            $sub = $sub->setParameters(array('dateInf' => $dateInf, 'dateSup' => $dateSup));
        }
        $sub = $sub->getQuery()
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

            if (!empty($subIds)) {
                $qb->andWhere($qb->expr()->notIn('e.id', $subIds));
            }

            if ($ville) {
                if ($distance) {
                    $this->_withinXkmVille($qb, $geolocalisation, $distance);
                } else {
                    $this->_whereVilleIs($qb, $ville);
                }
            }

            $linked->setParameter('type', $t);
            $results = array_merge($results, $linked->getQuery()->getResult());
        }

        return array_map('current', $results);
    }

    /**
     * EtablissementAutocomplete permet l'autocomplétion de l'établissement en fonction de plusieurs paramètres
     *
     * @param string $term       Ce qui est tapé dans le champs
     * @param string $dep        Le département
     * @param string $ville      La ville
     * @param array  $typeEns    Le type d'enseignement
     * @param array  $typeCentre Le type de centre de loisirs
     * @param array  $typeAutre  Le type d'autre établissement
     *
     * @return array
     */
    public function etablissementAutocomplete($term, $dep, $ville, $typeEns, $typeCentre, $typeAutre) {
        // Construction de la requête : on récupère les établissements dont le nom commence par ce qui est tapé
        $qb = $this
            ->createQueryBuilder('e')
            ->where('e.nom LIKE :name');

        // Nous testons si un département a été envoyé dans la requête
        if ($dep) {
            // Si oui, nous récupérons seulement les établissements situées dans ce département
            $qb
                ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
                ->andWhere('e.adresse = a')
                ->from('Unipik\ArchitectureBundle\Entity\Ville', 'v')
                ->andWhere('a.ville = v')
                ->innerJoin('v.codePostal', 'cp')
                ->from('Unipik\ArchitectureBundle\Entity\Departement', 'd')
                ->andWhere('cp.departement = d')
                ->andWhere('d.nom = :dep')
                ->setParameter('dep', $dep);
        }

        // Nous testons si une ville a été envoyée dans la requete
        if ($ville) {
            // Si oui, nous récupérons les établissements de cette ville
            $qb
                ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'ad')
                ->andWhere('e.adresse = ad')
                ->from('Unipik\ArchitectureBundle\Entity\Ville', 'vi')
                ->andWhere('ad.ville = vi')
                ->andWhere('vi.nom = :ville')
                ->setParameter('ville', $ville);
        }


        // Nous testons si l'etablissement est de type enseignement
        if ($typeEns) {
            // Si oui, nous récupérons seulement les etablissements de ce type

            $qb
                ->andWhere('e.typeEnseignement = :ens')
                ->setParameter('ens', $typeEns);
        }

        // Nous testons si l'etablissement est de type centreLoisirs
        if ($typeCentre) {
            // Si oui, nous récupérons seulement les etablissements de ce type
            $qb
                ->andWhere('e.typeCentre = :centre')
                ->setParameter('centre', $typeCentre);
        }

        // Nous testons si l'etablissement est de type autre
        if ($typeAutre) {
            // Si oui, nous récupérons seulement les etablissements de ce type
            $qb
                ->andWhere('e.typeAutreEtablissement = :autre')
                ->setParameter('autre', $typeAutre);
        }

        // Récupération des résultats
        return $qb
            ->setParameter('name', '%'.$term.'%')
            ->orderBy('e.nom', 'ASC')
            ->getQuery()
            ->getResult();
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

    /**
     * Verifie si un point est dans une distance du domicile
     *
     * @param QueryBuilder $qb       Le querybuilder
     * @param user         $user     L'utilisateur
     * @param distance     $distance La distance
     *
     * @return void
     */
    private function _withinXkmDomicile(QueryBuilder $qb, $user, $distance) {
        $qb
            ->from('Unipik\UserBundle\Entity\Benevole', 'b')
            ->andWhere('b = :user')
            ->setParameter('user', $user)
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'adresse')
            ->andWhere('b.adresse = adresse')
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
            ->andWhere('e.adresse = a')
            ->andWhere(
                $qb->expr()->eq(
                    sprintf("STDWithin(a.geolocalisation, adresse.geolocalisation, :distance)"),
                    $qb->expr()->literal(true)
                )
            )
            ->setParameter('distance', $distance*1000);
    }

    /**
     * Verifie si un point est dans une distance d'une ville
     *
     * @param QueryBuilder $qb              Le querybuilder
     * @param string       $geolocalisation La géolocalisation de la ville
     * @param string       $distance        La distance
     *
     * @return void
     */
    private function _withinXkmVille(QueryBuilder $qb, $geolocalisation, $distance) {
        $qb
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
            ->andWhere('e.adresse = a')
            ->andWhere(
                $qb->expr()->eq(
                    sprintf("STDWithin(a.geolocalisation, :geolocalisation, :distance)"),
                    $qb->expr()->literal(true)
                )
            )
            ->setParameter('geolocalisation', $geolocalisation)
            ->setParameter('distance', $distance*1000);
    }

    /**
     * Retourne les etéblissements qui ont une intervention dans une semaine.
     *
     * @return array
     */
    public function getEmailEtablissementRappel() {
        $dateTime = new \DateTime();
        $dateTime->add(new \DateInterval('P7D'));
        $date = ''.$dateTime->format('Y-m-d');

        $qb = $this->createQueryBuilder('e')
            ->select('e.id')
            ->from('InterventionBundle:Intervention', 'i')
            ->where('e.id = i.etablissement')
            ->andWhere('i.dateIntervention = \''.$date.'\'');

        return array_map('current', $qb->getQuery()->getResult());
    }

    /**
     * Retourne les etablissements avec une demande non satisfaite
     *
     * @return array
     */
    public function getEtablissementDemandeNonSatisfaite() {
        $dateInf = date('Y').'-09-01';
        $dateSup = (date('Y')+1).'-09-01';

        $sub = $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('IDENTITY(i.etablissement)')
            ->from('InterventionBundle:Intervention', 'i')
            ->join('i.demande', 'd')
            ->where('d.dateDemande > :dateInf')
            ->andWhere('d.dateDemande < :dateSup')
            ->andWhere('i.dateIntervention < :date')
            ->andWhere('i.realisee = false')
            ->setParameters(array('date' => (new \DateTime())->format('Y-m-d'), 'dateInf' => $dateInf, 'dateSup' => $dateSup))
            ->getQuery()
            ->getResult();

        return array_map('current', $sub);
    }

    public function getTop10Etablissements() {
//        SELECT e.*, COUNT(i.id) FROM etablissement e, intervention i WHERE e.id = i.etablissement_id GROUP BY e.id ORDER BY COUNT(i.id) DESC LIMIT 10

        $qb = $this->createQueryBuilder('e')
            ->addSelect('e.nom as etabNom, e.id as etabId, count(i.id) as count1')
            ->from('InterventionBundle:Intervention', 'i')
            ->where('i.etablissement = e')
            ->groupBy('e.id')
            ->orderBy('count1', 'DESC')
            ->setMaxResults(10)
        ;

        return $qb->getQuery()->getResult();
    }
}
