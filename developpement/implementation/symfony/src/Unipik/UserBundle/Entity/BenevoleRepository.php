<?php
/**
 * Created by PhpStorm.
 * User: Kafui
 * Date: 13/09/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\QueryBuilder;
use OpsWay\Doctrine\ORM\Query\AST\Functions\Contains;

/**
 * Class BenevoleRepository
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class BenevoleRepository extends EntityRepository {

    /**
     * Generic function for DB queries.
     *
     * @param string $field           Le champs
     * @param bool   $desc            Descendant ou non
     * @param string $ville           La ville
     * @param geoloc $geolocalisation La geolocalisation
     * @param geoloc $distance        La distance
     * @param User   $user            L'utilisateur
     *
     * @return array
     */
    public function getType($field, $desc, $ville, $geolocalisation=null, $distance=null, $user=null) {
        $qb = $this->createQueryBuilder('b');
        $qb = $qb->where('b.nom != :nom')
            ->setParameter('nom', 'anonyme');

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

        if ($field=="nom") {
            if ($desc) {
                $qb = $qb->orderBy('b.nom', 'DESC');
            } else {
                $qb = $qb->orderBy('b.nom', 'ASC');
            }
        } else {
            if ($desc) {
                $qb = $qb->orderBy('b.prenom', 'DESC');
            } else {
                $qb = $qb->orderBy('b.prenom', 'ASC');
            }
        }

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * Benevoles par activites
     *
     * @param QueryBuilder $qb  Le querybuilder
     * @param string       $act Les activites
     *
     * @return object
     *
     * @deprecated
     */
    private function _getBenevolesByActivites(QueryBuilder $qb, $act) {
        $qb
            ->andWhere('b.activitePotentielle @> array_append(ARRAY[]::type_activite[],:a)')
            ->setParameter('a', '('.$act[0].')');

        for ($i = 1; $i < (count($act)-1); $i+=1) {
            $qb
                ->andWhere('b.activitePotentielle @> array_append(ARRAY[]::type_activite[],:a)')
                ->setParameter('a', '('.$act[$i].')');
        }

    }

    /**
     * Benevoles par responsabilites
     *
     * @param QueryBuilder $qb   Le querybuilder
     * @param string       $resp Les responsabilites
     *
     * @return object
     *
     * @deprecated
     */
    private function _getBenevolesByResponsabilites(QueryBuilder $qb, $resp) {
        $qb
            ->andWhere('b.responsabiliteActivite @> array_append(ARRAY[]::type_responsabilite_activite[],:a)')
            ->setParameter('a', '('.$resp[0].')');

        for ($i = 1; $i < (count($resp)-1); $i+=1) {
            $qb
                ->andWhere('b.responsabiliteActivite @> array_append(ARRAY[]::type_responsabilite_activite[],:a)')
                ->setParameter('a', '('.$resp[$i].')');
        }

    }

    /**
     * Requete pour une ville
     *
     * @param QueryBuilder $qb    Le querybuilder
     * @param string       $ville La ville
     *
     * @return object
     */
    private function _whereVilleIs(QueryBuilder $qb, $ville) {
        $qb
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'ad')
            ->andWhere('b.adresse = ad')
            ->andWhere('ad.ville = :ville')
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
            ->from('Unipik\UserBundle\Entity\Benevole', 'be')
            ->andWhere('be = :user')
            ->setParameter('user', $user)
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'adresse')
            ->andWhere('be.adresse = adresse')
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'a')
            ->andWhere('b.adresse = a')
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
            ->from('Unipik\ArchitectureBundle\Entity\Adresse', 'ad')
            ->andWhere('b.adresse = ad')
            ->andWhere(
                $qb->expr()->eq(
                    sprintf("STDWithin(ad.geolocalisation, :geolocalisation, :distance)"),
                    $qb->expr()->literal(true)
                )
            )
            ->setParameter('geolocalisation', $geolocalisation)
            ->setParameter('distance', $distance*1000);
    }

    //    /**
    //     * @param $ville
    //     * @param $act
    //     * @param $resp
    //     * @return array
    //     */
    //    public function getBenevoles($ville, $act, $resp){
    //
    //        $rsm = new ResultSetMapping;
    //        $rsm->addEntityResult('Unipik\UserBundle\Entity\Benevole', 'b');
    //
    //        $sql="SELECT * FROM benevole b ;";
    //        $query = $this->_em->createNativeQuery($sql,$rsm);
    //        $results = $query->getResult();
    //
    //        if(!empty($act)){
    //            $rsm->addFieldResult('b','activites_potentielles','activitesPotentielles');
    //            foreach ($act as $a){
    //                $sql = "SELECT b FROM benevole b WHERE b.activites_potentielles @> array_append(ARRAY[]::type_activite[],:a);";
    //                $query = $this->_em->createNativeQuery($sql,$rsm);
    //                $query->setParameter('a','('.$a.')');
    //                $results = array_merge($results,$query->getResult());
    //            }
    //        }
    //
    //        if(!empty($resp)){
    //            $rsm->addFieldResult('b','responsabilite_activite','responsabiliteActivite');
    //            foreach ($resp as $r){
    //                $sql = "SELECT b FROM benevole b WHERE b.responsabilite_activite @> array_append(ARRAY[]::type_responsabilite_activite[],:a);";
    //                $query = $this->_em->createNativeQuery($sql,$rsm);
    //                $query->setParameter('a','('.$r.')');
    //                $results = array_merge($results,$query->getResult());
    //            }
    //        }
    //
    //        if($ville){
    //            $rsm->addEntityResult('Unipik\ArchitectureBundle\Entity\Adresse', 'a');
    //            $rsm->addFieldResult('b','adresse_id','adresse');
    //            $rsm->addFieldResult('a','id','id');
    //            $rsm->addFieldResult('a','adresse_id','adresse');
    //            $sql = "SELECT b FROM benevole b, Adresse a WHERE b.adresse_id=a.id AND WHERE a.ville_id = :ville);";
    //            $query = $this->_em->createNativeQuery($sql,$rsm);
    //            $query->setParameter('ville',$ville->getId());
    //            $results = array_merge($results,$query->getResult());
    //        }
    //        return $results;
    //    }

    /**
     * Renvoie l'email d'un benevole pour rappel
     *
     * @return array
     */
    public function getEmailBenevoleRappel() {
        $dateTime = new \DateTime();
        $dateTime->add(new \DateInterval('P7D'));
        $date = ''.$dateTime->format('d/m/Y');

        $qb = $this->createQueryBuilder('b')
            ->select('DISTINCT b.email')
            ->from('InterventionBundle:Intervention', 'i')
            ->where('b.id = i.benevole')
            ->andWhere('i.dateIntervention = \''.$date.'\'');

        return array_map('current', $qb->getQuery()->getResult());
    }
}
