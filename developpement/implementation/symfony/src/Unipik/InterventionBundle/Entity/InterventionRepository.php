<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 09/09/16
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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Unipik\InterventionBundle\Form\Intervention\InterventionType;
use Unipik\InterventionBundle\InterventionBundle;

/**
 * Le repository qui gère les interventions
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class InterventionRepository extends EntityRepository {

    /**
     * Generic function for DB queries.
     *
     * @param date             $start            Le debut
     * @param date             $end              La fin
     * @param bool             $dateChecked      La date est elle cochée
     * @param InterventionType $typeIntervention Le type d'intervention
     * @param string           $field            Le champ de tri
     * @param bool             $desc             Descendant
     * @param string           $statut           Le statut
     * @param array            $mesInterventions Mes interventions
     * @param user             $user             L'utilisateur
     * @param array            $niveauFrimousse  Le niveau en cas de frimousse
     * @param array            $niveauPlaidoyer  Le niveau en cas de plaidoyer
     * @param string           $theme            Le theme
     * @param string           $ville            La ville
     * @param distance         $distance         La distance
     * @param geoloc           $geolocalisation  La geolocalisation
     *
     * @return array
     */
    public function getType($start, $end, $dateChecked, $typeIntervention, $field, $desc, $statut, $mesInterventions, $user = null, $niveauFrimousse = null, $niveauPlaidoyer = null, $theme = null, $ville = null, $distance = null, $geolocalisation = null ) {

        $qb = $this->createQueryBuilder('i');

        switch ($typeIntervention) {
        case "plaidoyer":
            $this->_getPlaidoyers($qb, $start, $end, $dateChecked);
            $qb
                ->from('\Unipik\ArchitectureBundle\Entity\NiveauTheme', 'nt')
                ->andWhere('i.niveauTheme = nt');
            if ($niveauPlaidoyer) {
                $req = "nt.niveau = '".$niveauPlaidoyer[0]."'";
                for ($i=1;$i<count($niveauPlaidoyer);$i++) {
                    $req = $req." OR nt.niveau = '".$niveauPlaidoyer[$i]."'";
                }
                $qb->andWhere($req);
            }
            if ($theme) {
                $req = "nt.theme = '".$theme[0]."'";
                for ($i=1;$i<count($theme);$i++) {
                    $req = $req." OR nt.theme = '".$theme[$i]."'";
                }
                $qb->andWhere($req);
            }
            break;
        case "frimousse":
            $this->_getFrimousses($qb, $start, $end, $dateChecked);
            if ($niveauFrimousse) {
                $req = "i.niveauFrimousse = '".$niveauFrimousse[0]."'";
                for ($i=1;$i<count($niveauFrimousse);$i++) {
                    $req = $req." OR i.niveauFrimousse = '".$niveauFrimousse[$i]."'";
                }
                $qb->andWhere($req);
            }
            break;
        case "autreIntervention":
            $this->_getAutresInterventions($qb, $start, $end, $dateChecked);
            break;
        default:
            $this->_getToutesInterventions($qb, $start, $end, $dateChecked);
            break;
        }

        switch ($statut) {
        case "attribuees":
            $this->_whereInterventionIsAttribuee($qb);
            break;
        case "nonAttribuees":
            $this->_whereInterventionIsNotAttribuee($qb);
            break;
        case "realisees":
            $this->_whereInterventionIsRealisee($qb);
            break;
        default:
            break;
        }

        if ($mesInterventions) {
            $qb->andWhere('i.benevole = :user')
                ->setParameter('user', $user);
        }


        if ($field=="lieu") {
            if ($desc) {
                $qb
                    ->from('Unipik\InterventionBundle\Entity\Etablissement', 'et')
                    ->andWhere('i.etablissement = et')
                    ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'ad')
                    ->andWhere('et.adresse = ad')
                    ->from('\Unipik\ArchitectureBundle\Entity\Ville', 'v')
                    ->andWhere('ad.ville = v')
                    ->orderBy('v.nom', 'DESC');
            } else {
                $qb
                    ->from('Unipik\InterventionBundle\Entity\Etablissement', 'et')
                    ->andWhere('i.etablissement = et')
                    ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'ad')
                    ->andWhere('et.adresse = ad')
                    ->from('\Unipik\ArchitectureBundle\Entity\Ville', 'v')
                    ->andWhere('ad.ville = v')
                    ->orderBy('v.nom', 'ASC');
            }

        } else {
            if ($desc) {
                $qb->orderBy('i.dateIntervention', 'DESC');
            } else {
                $qb->orderBy('i.dateIntervention', 'ASC');
            }
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

        return $qb

            ->getQuery()
            ->getResult();
    }

    /**
     * Get Frimousses
     *
     * @param QueryBuilder $qb           Le QueryBuilder
     * @param date         $start        La date de debut
     * @param date         $end          La date de fin
     * @param bool         $datesChecked La date est cochee
     *
     * @return QueryBuilder
     */
    private function _getFrimousses(QueryBuilder $qb, $start, $end, $datesChecked) {

        $qb
            ->where("i.typeIntervention = 'frimousse'");


        if (!$datesChecked) {
            $this->_whereInterventionsBetweenDates($start, $end, $qb);
        } else {
            $this->_whereInterventionsInTheTwoLastYear($qb);
        }
    }

    /**
     * Get Plaidoyers
     *
     * @param QueryBuilder $qb           Le QueryBuilder
     * @param date         $start        La date de debut
     * @param date         $end          La date de fin
     * @param bool         $datesChecked La date est cochee
     *
     * @return QueryBuilder
     */
    private function _getPlaidoyers(QueryBuilder $qb, $start, $end, $datesChecked) {

        $qb
            ->where("i.typeIntervention = 'plaidoyer'");

        if (!$datesChecked) {
            $this->_whereInterventionsBetweenDates($start, $end, $qb);
        } else {
            $this->_whereInterventionsInTheTwoLastYear($qb);
        }
    }

    /**
     * Get Autres Interventions
     *
     * @param QueryBuilder $qb           Le QueryBuilder
     * @param date         $start        La date de debut
     * @param date         $end          La date de fin
     * @param bool         $datesChecked La date est cochee
     *
     * @return QueryBuilder
     */
    private function _getAutresInterventions(QueryBuilder $qb,$start,  $end , $datesChecked) {

        $qb
            ->where("i.typeIntervention = 'autre_intervention'");

        if (!$datesChecked) {
            $this->_whereInterventionsBetweenDates($start, $end, $qb);
        } else {
            $this->_whereInterventionsInTheTwoLastYear($qb);
        }
    }


    /**
     *  Get Toutes Interventions
     *
     * @param QueryBuilder $qb           Le QueryBuilder
     * @param date         $start        La date de debut
     * @param date         $end          La date de fin
     * @param bool         $datesChecked La date est cochee
     *
     * @return QueryBuilder
     */
    private function _getToutesInterventions(QueryBuilder $qb, $start,  $end , $datesChecked) {

        if (!$datesChecked) {
            $this->_whereInterventionsBetweenDates($start, $end, $qb);
        } else {
            $this->_whereInterventionsInTheTwoLastYear($qb);
        }

    }

    /**
     * Get Interventions d'un bénévole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole Le benevole
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterventionsBenevole(\Unipik\UserBundle\Entity\Benevole $benevole) {
        $query = $this->_em->createQuery('SELECT i FROM InterventionBundle:Intervention i JOIN i.benevole b WHERE b.id = :id');
        $query->setParameter('id', $benevole->getId());

        return $query->getResult();
    }

    /**
     * Get Interventions réalisées ou non réalisées
     *
     * @param boolean $realisees Realisee ou non
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterventionsRealiseesOuNon($realisees) {
        $query = $this->_em->createQuery('SELECT i FROM InterventionBundle:Intervention i WHERE i.realisee = :r');
        $query->setParameter('r', $realisees);

        return $query->getResult();
    }

    /**
     * Get Interventions réalisées ou non réalisées d'un bénévole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole  Le benevole
     * @param boolean                            $realisees Realisee ou non
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterventionsRealiseesOuNonBenevole($benevole, $realisees) {
        $query = $this->_em->createQuery('SELECT i FROM InterventionBundle:Intervention i  JOIN i.benevole b  WHERE i.realisee = :r AND b.id = :id ORDER BY i.dateIntervention ASC');
        $query->setParameter('r', $realisees);
        $query->setParameter('id', $benevole->getId());

        return new ArrayCollection($query->getResult());
    }

    /**
     * Get Interventions associées à une demande
     *
     * @param demande $demande La demande
     *
     * @return ArrayCollection
     */
    public function getInterventionsDeDemande($demande) {
        $query = $this->_em->createQuery('SELECT i FROM InterventionBundle:Intervention i  WHERE i.demande = :r ');
        $query->setParameter('r', $demande);

        return new ArrayCollection($query->getResult());
    }

    /**
     * Get Interventions réalisées ou non réalisées d'un bénévole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole   Le benevole
     * @param boolean                            $realisees  Realisee ou non
     * @param int                                $maxResults Le nombre max de resultats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNInterventionsRealiseesOuNonBenevole($benevole, $realisees, $maxResults) {
        $query = $this->_em->createQuery('SELECT i FROM InterventionBundle:Intervention i JOIN i.benevole b WHERE i.realisee = :r AND b.id = :id ORDER BY i.dateIntervention ASC');
        $query->setParameter('r', $realisees);
        $query->setParameter('id', $benevole->getId());
        $query->setMaxResults($maxResults);
        return new ArrayCollection($query->getResult());
    }

    /**
     * Get Interventions réalisées ou non réalisées qu'un établissement a demandé
     *
     * @param \Unipik\InterventionBundle\Entity\Etablissement $etablissement L'etablissement
     * @param boolean                                         $realisees     Realisee ou non
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterventionsRealiseesOuNonEtablissement($etablissement, $realisees) {
        $query = $this->_em->createQuery('SELECT i FROM InterventionBundle:Intervention i  JOIN i.etablissement e  WHERE i.realisee = :r AND e.id = :id ORDER BY i.dateIntervention ASC');
        $query->setParameter('r', $realisees);
        $query->setParameter('id', $etablissement->getId());

        return new ArrayCollection($query->getResult());
    }


    /**
     * Where Interventions between dates
     *
     * @param \DateTime    $start Le debut
     * @param \DateTime    $end   La fin
     * @param QueryBuilder $qb    Le querybuilder
     *
     * @return object
     */
    private function _whereInterventionsBetweenDates($start, $end, QueryBuilder $qb) {
        $qb
            ->join('i.demande', 'd')
            ->andWhere(
                '( d.dateDebutDisponibilite >= :start AND d.dateDebutDisponibilite <= :end AND i.dateIntervention IS NULL) OR
            (d.dateFinDisponibilite >= :start AND d.dateFinDisponibilite <= :end AND i.dateIntervention IS NULL ) OR
            (d.dateDebutDisponibilite <= :start AND d.dateFinDisponibilite >= :end AND i.dateIntervention IS NULL ) OR
            (i.dateIntervention BETWEEN :start AND :end )'
            )
            ->setParameter('start', $start)
            ->setParameter('end', $end);
    }

    /**
     * Where intervention in the two last years
     *
     * @param QueryBuilder $qb Le queryBuilder
     *
     * @return object
     */
    private function _whereInterventionsInTheTwoLastYear(QueryBuilder $qb) {
        $date = date('Y-m-d', strtotime('-2 years', strtotime('now')));
        $qb
            ->join('i.demande', 'd')
            ->andWhere('d.dateDemande >= :twoYearsAgo')
            ->setParameter('twoYearsAgo', $date);
    }

    /**
     * Renvoie les interventions attribuees
     *
     * @param QueryBuilder $qb Le querybuilder
     *
     * @return object
     */
    private function _whereInterventionIsAttribuee(QueryBuilder $qb) {
        $qb
            ->andWhere($qb->expr()->isNotNull('i.benevole'))
            ->andWhere($qb->expr()->eq('i.realisee', $qb->expr()->literal(false)));
    }

    /**
     * Renvoie les interventions non attribuees
     *
     * @param QueryBuilder $qb Le querybuilder
     *
     * @return object
     */
    private function _whereInterventionIsNotAttribuee(QueryBuilder $qb) {
        $qb
            ->andWhere($qb->expr()->isNull('i.benevole'));
    }

    /**
     * Renvoie les interventions realisees
     *
     * @param QueryBuilder $qb Le querybuilder
     *
     * @return object
     */
    private function _whereInterventionIsRealisee(QueryBuilder $qb) {
        $qb
            ->andWhere($qb->expr()->isNotNull('i.benevole'))
            ->andWhere($qb->expr()->eq('i.realisee', $qb->expr()->literal(true)));
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
            ->from('Unipik\InterventionBundle\Entity\Etablissement', 'e')
            ->andWhere('i.etablissement = e')
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
            ->from('Unipik\InterventionBundle\Entity\Etablissement', 'e')
            ->andWhere('i.etablissement = e')
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
     * Obtenir les interventions selon l'email du benevole
     *
     * @param string $email Email du bénévole
     *
     * @return array Interventions du bénévole
     */
    public function getInterventionByBenevoleEmailRappel($email) {
        $dateTime = new \DateTime();
        $dateTime->add(new \DateInterval('P7D'));
        $date = ''.$dateTime->format('d/m/Y');

        $qb = $this->createQueryBuilder('i')
            ->select('i')
            ->from('UserBundle:Benevole', 'b')
            ->where('b.id = i.benevole')
            ->andWhere('b.email = :email')
            ->setParameter('email', $email)
            ->andWhere('i.dateIntervention = \''.$date.'\'');

        return $qb->getQuery()->getResult();
    }

    /**
     * Obtenir les interventions selon l'id de l'etablissement
     *
     * @param int $id L'id de l'etablissement
     *
     * @return array
     */
    public function getInterventionByEtablissementIdRappel($id) {
        $dateTime = new \DateTime();
        $dateTime->add(new \DateInterval('P7D'));
        $date = ''.$dateTime->format('d/m/Y');

        $qb = $this->createQueryBuilder('i')
            ->select('i')
            ->from('InterventionBundle:Etablissement', 'e')
            ->where('i.etablissement = e.id')
            ->andWhere('e.id = :id')
            ->setParameter('id', $id)
            ->andWhere('i.dateIntervention = \''.$date.'\'');

        return $qb->getQuery()->getResult();
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
            ->from('Unipik\InterventionBundle\Entity\Etablissement', 'e')
            ->andWhere('i.etablissement = e')
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
     * Renvoie le nombre d'interventions réalisées
     *
     * @param null $dateSup           La date superieure
     * @param null $dateInf           La date Inferieure
     * @param null $typeEtablissement Le type d'etablissement
     * @param null $typeIntervention  Le type d'intervention
     *
     * @return mixed
     */
    public function getNumberInterventionRealisee($dateSup = null, $dateInf = null, $typeEtablissement = null, $typeIntervention = null) {
        $qb = $this->createQueryBuilder('i')
            ->select('count(i)')
            ->where('i.realisee = true')
            ->join('i.etablissement', 'e');

        if (isset($typeIntervention)) {
            $qb->andWhere('i.typeIntervention = :typeIntervention')
                ->setParameter('typeIntervention', $typeIntervention);
        }

        if (isset($dateSup)) {
            $qb->andWhere('i.dateIntervention < :dateSup')
                ->setParameter('dateSup', $dateSup);
        }

        if (isset($dateInf)) {
            $qb->andWhere('i.dateIntervention > :dateInf')
                ->setParameter('dateInf', $dateInf);
        }

        if (isset($typeEtablissement)) {
            $qb->andWhere('e.typeEnseignement = :typeEtablissement')
                ->setParameter('typeEtablissement', $typeEtablissement);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Renvoie le nombre d'interventions réalisées
     *
     * @param $theme string Le thème
     * @param null $dateSup           La date superieure
     * @param null $dateInf           La date Inferieure
     *
     * @return mixed
     */
    public function getNumberInterventionByThemeAndNiveau($theme, $dateSup = null, $dateInf = null, $niveau = null) {
        $qb = $this->createQueryBuilder('i')
            ->select('count(i)')
            ->where('i.realisee = true')
            ->andWhere('i.typeIntervention = \'plaidoyer\'')
            ->join('i.niveauTheme', 'nt')
            ->andWhere('nt.theme = :theme')
            ->setParameter('theme', $theme)
        ;

        if(isset($niveau)) {
            $qb->join('i.etablissement', 'e')
                ->andWhere('e.typeEnseignement = :niveau')
                ->setParameter('niveau', $niveau)
            ;
        }

        if (isset($dateSup)) {
            $qb->andWhere('i.dateIntervention < :dateSup')
                ->setParameter('dateSup', $dateSup);
        }

        if (isset($dateInf)) {
            $qb->andWhere('i.dateIntervention > :dateInf')
                ->setParameter('dateInf', $dateInf);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Renvoie le nombre d'intervention par niveau
     *
     * @param Niveau $niveau Le niveau
     * @param null $dateSup La date sup
     * @param null $dateInf La date inf
     *
     * @return mixed
     */
    public function getNumberInterventionByNiveau($niveau, $dateSup = null, $dateInf = null) {
        $qb = $this->createQueryBuilder('i')
            ->select('count(i)')
            ->where('i.realisee = true')
            ->andWhere('i.typeIntervention = \'plaidoyer\'')
            ->join('i.etablissement', 'e')
            ->andWhere('e.typeEnseignement = :niveau')
            ->setParameter('niveau', $niveau)
        ;

        if (isset($dateSup)) {
            $qb->andWhere('i.dateIntervention < :dateSup')
                ->setParameter('dateSup', $dateSup);
        }

        if (isset($dateInf)) {
            $qb->andWhere('i.dateIntervention > :dateInf')
                ->setParameter('dateInf', $dateInf);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getNumberInterventionPerMonth($dateSup, $dateInf) {
        $qb = $this->createQueryBuilder('i')
            ->select('i.dateIntervention')
            ->where('i.realisee = true')
            ->andWhere('i.dateIntervention < :dateSup')
            ->setParameter('dateSup', $dateSup)
            ->andWhere('i.dateIntervention > :dateInf')
            ->setParameter('dateInf', $dateInf)
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * Renvoie le nombre d'interventions réalisées
     *
     * @param null $dateSup           La date superieure
     * @param null $dateInf           La date Inferieure
     *
     * @return mixed
     */
    public function getNumberInterventionByAllTheme($dateSup = null, $dateInf = null) {
        $qb = $this->createQueryBuilder('i')
            ->select('count(i)')
            ->where('i.realisee = true')
            ->andWhere('i.typeIntervention = \'plaidoyer\'')
            ->join('i.niveauTheme', 'nt')
            ->orderBy("nt.theme")
        ;

        if (isset($dateSup)) {
            $qb->andWhere('i.dateIntervention < :dateSup')
                ->setParameter('dateSup', $dateSup);
        }

        if (isset($dateInf)) {
            $qb->andWhere('i.dateIntervention > :dateInf')
                ->setParameter('dateInf', $dateInf);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @param $niveau
     * @param null $dateSup
     * @param null $dateInf
     * @return mixed
     */
    public function getElevesSensibilise($niveau, $dateSup = null, $dateInf = null) {
        $qb = $this->createQueryBuilder('i')
            ->select('sum(i.nbPersonne)')
            ->where('i.realisee = true')
            ->andWhere('i.typeIntervention = \'plaidoyer\'')
            ->join('i.etablissement', 'e')
            ->andWhere('e.typeEnseignement = :niveau')
            ->setParameter('niveau', $niveau)
        ;

        if (isset($dateSup)) {
            $qb->andWhere('i.dateIntervention < :dateSup')
                ->setParameter('dateSup', $dateSup);
        }

        if (isset($dateInf)) {
            $qb->andWhere('i.dateIntervention > :dateInf')
                ->setParameter('dateInf', $dateInf);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }
}
