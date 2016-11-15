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
class BenevoleRepository extends EntityRepository
{
    /**
     * Generic function for DB queries.
     *
     * @param string $field Le champs
     * @param bool   $desc  Descendant ou non
     * @param string $ville La ville
     *
     * @return array
     */
    public function getType($field, $desc, $ville){
        $qb = $this->createQueryBuilder('b');

        if ($ville) {
            $this->_whereVilleIs($qb, $ville);
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
    private function _getBenevolesByActivites(QueryBuilder $qb, $act){
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
    private function _getBenevolesByResponsabilites(QueryBuilder $qb, $resp){
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



}
