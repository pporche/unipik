<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 09/09/16
 * Time: 16:55
 */

namespace Unipik\InterventionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class InterventionRepository extends EntityRepository {

    /**
     * Generic function for DB queries.
     *
     * @param  $start
     * @param  $end
     * @param  $dateChecked
     * @param  $typeIntervention
     * @param  $field
     * @param  $desc
     * @param  $statut
     * @param  $user
     * @return array
     */
    public function getType($start, $end, $dateChecked, $typeIntervention, $field, $desc, $statut, $user = null, $niveauFrimousse = null, $niveauPlaidoyer = null, $theme = null, $ville = null/*, $distance = null*/ ){

        $qb = $this->createQueryBuilder('i');

        switch ($typeIntervention) {
        case "plaidoyer":
            $this->getPlaidoyers($qb, $start, $end, $dateChecked);
            $qb
                ->from('\Unipik\ArchitectureBundle\Entity\NiveauTheme', 'nt')
                ->andWhere('i.niveauTheme = nt');
            if($niveauPlaidoyer) {
                $req = "nt.niveau = '".$niveauPlaidoyer[0]."'";
                for($i=1;$i<count($niveauPlaidoyer);$i++) {
                    $req = $req." OR nt.niveau = '".$niveauPlaidoyer[$i]."'";
                }
                $qb->andWhere($req);
            }
            if($theme) {
                $req = "nt.theme = '".$theme[0]."'";
                for($i=1;$i<count($theme);$i++) {
                    $req = $req." OR nt.theme = '".$theme[$i]."'";
                }
                $qb->andWhere($req);
            }
            break;
        case "frimousse":
            $this->getFrimousses($qb, $start, $end, $dateChecked);
            if($niveauFrimousse) {
                $req = "i.niveauFrimousse = '".$niveauFrimousse[0]."'";
                for($i=1;$i<count($niveauFrimousse);$i++) {
                    $req = $req." OR i.niveauFrimousse = '".$niveauFrimousse[$i]."'";
                }
                $qb->andWhere($req);
            }
            break;
        case "autreIntervention":
            $this->getAutresInterventions($qb, $start, $end, $dateChecked);
            break;
        default:
            $this->getToutesInterventions($qb, $start, $end, $dateChecked);
            break;
        }

        switch ($statut) {
        case "attribuees":
            $this->getInterventionsAttribuees($qb);
            break;
        case "nonAttribuees":
            $this->getInterventionsNonAttribuees($qb);
            break;
        case "realisees":
            $this->getInterventionsRealisees($qb);
            break;
        default:
            break;
        }

        if ($user) {
            $qb->andWhere('i.benevole = :user')
                ->setParameter('user', $user);
        }


        if($field=="lieu") {
            if($desc) {
                $qb
                    ->from('Unipik\InterventionBundle\Entity\Etablissement', 'e')
                    ->andWhere('i.etablissement = e')
                    ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
                    ->andWhere('e.adresse = a')
                    ->from('\Unipik\ArchitectureBundle\Entity\Ville', 'v')
                    ->andWhere('a.ville = v')
                    ->orderBy('v.nom', 'DESC');
            }else{
                $qb
                    ->from('Unipik\InterventionBundle\Entity\Etablissement', 'e')
                    ->andWhere('i.etablissement = e')
                    ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
                    ->andWhere('e.adresse = a')
                    ->from('\Unipik\ArchitectureBundle\Entity\Ville', 'v')
                    ->andWhere('a.ville = v')
                    ->orderBy('v.nom', 'ASC');
            }

        }else{
            if($desc) {
                $qb->orderBy('i.dateIntervention', 'DESC');
            }else{
                $qb->orderBy('i.dateIntervention', 'ASC');
            }
        }

        if($ville) {
            $this->whereVilleIs($qb, $ville);
        }

        //        if(isset($distance)){
        //            $this->within10km($qb, $distance);
        //        }

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * Get Frimousses
     *
     * @param  $start
     * @param  $end
     * @param  $datesChecked
     * @return QueryBuilder
     */
    public function getFrimousses(QueryBuilder $qb, $start, $end, $datesChecked) {

        $qb
            ->where($qb->expr()->isNotNull('i.niveauFrimousse'))
            ->andWhere($qb->expr()->isNotNull('i.materiauxFrimousse'));

        if(!$datesChecked) {
            $this->whereInterventionsBetweenDates($start, $end, $qb);
        }
    }

    /**
     * Get Plaidoyers
     *
     * @param  $start
     * @param  $end
     * @param  $datesChecked
     * @return QueryBuilder
     */
    public function getPlaidoyers(QueryBuilder $qb, $start, $end, $datesChecked) {

        $qb
            ->where($qb->expr()->isNotNull('i.niveauTheme'))
            ->andWhere($qb->expr()->isNotNull('i.materielDispoPlaidoyer'));

        if(!$datesChecked) {
            $this->whereInterventionsBetweenDates($start, $end, $qb);
        }
    }

    /**
     * Get Autres Interventions
     *
     * @param  $start
     * @param  $end
     * @param  $datesChecked
     * @return QueryBuilder
     */
    public function getAutresInterventions(QueryBuilder $qb,$start,  $end , $datesChecked) {

        $qb
            ->where($qb->expr()->isNotNull('i.description'));

        if(!$datesChecked) {
            $this->whereInterventionsBetweenDates($start, $end, $qb);
        }
    }


    /**
     *  Get Toutes Interventions
     *
     * @param  $start
     * @param  $end
     * @param  $datesChecked
     * @return QueryBuilder
     */
    public function getToutesInterventions(QueryBuilder $qb, $start,  $end , $datesChecked) {

        if(!$datesChecked) {
            $this->whereInterventionsBetweenDates($start, $end, $qb);
        }

    }

    /**
     * Get Interventions d'un bénévole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole
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
     * @param boolean $realisees
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
     * @param boolean                            $realisees
     * @param \Unipik\UserBundle\Entity\Benevole $benevole
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
     * Get Interventions réalisées ou non réalisées d'un bénévole
     *
     * @param boolean                            $realisees
     * @param \Unipik\UserBundle\Entity\Benevole $benevole
     * @param int                                $maxResults
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
     * @param boolean                                         $realisees
     * @param \Unipik\InterventionBundle\Entity\Etablissement $etablissement
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
     * @param \DateTime $start
     * @param \DateTime $end
     */
    public function whereInterventionsBetweenDates($start, $end, QueryBuilder $qb) {
        $qb
            ->andWhere('i.dateIntervention BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end);
    }

    /**
     * @param QueryBuilder $qb
     */
    public function getInterventionsAttribuees(QueryBuilder $qb){
        $qb
            ->andWhere($qb->expr()->isNotNull('i.benevole'))
            ->andWhere($qb->expr()->eq('i.realisee', $qb->expr()->literal(false)));
    }

    /**
     * @param QueryBuilder $qb
     */
    public function getInterventionsNonAttribuees(QueryBuilder $qb){
        $qb
            ->andWhere($qb->expr()->isNull('i.benevole'));
    }

    /**
     * @param QueryBuilder $qb
     */
    public function getInterventionsRealisees(QueryBuilder $qb){
        $qb
            ->andWhere($qb->expr()->isNotNull('i.benevole'))
            ->andWhere($qb->expr()->eq('i.realisee', $qb->expr()->literal(true)));
    }


    /**
     * Where ville is
     *
     * @param QueryBuilder $qb
     * @param $ville
     */
    public function whereVilleIs(QueryBuilder $qb, $ville) {
        $qb
            ->from('Unipik\InterventionBundle\Entity\Etablissement', 'e')
            ->andWhere('i.etablissement = e')
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
            ->andWhere('e.adresse = a')
            ->andWhere('a.ville = :ville')
            ->setParameter('ville', $ville);
    }

    //    /**
    //     * @param QueryBuilder $qb
    //     * @param $ville
    //     */
    //    public function within10km(QueryBuilder $qb, $distance) {
    //        $qb
    //            ->andWhere(
    //                $qb->expr()->eq(
    //                    sprintf("ST_Distance()", $geoJsonPolygon),
    //                    $qb->expr()->literal(true)
    //                )
    //            );
    //
    //
    //
    //            ->from('Unipik\InterventionBundle\Entity\Etablissement','e')
    //            ->andWhere('i.etablissement = e')
    //            ->from('Unipik\ArchitectureBundle\Entity\Adresse','a')
    //            ->andWhere('e.adresse = a')
    //            ->andWhere('a.ville = :ville')
    //            ->setParameter('ville',$ville);
    //    }
}
