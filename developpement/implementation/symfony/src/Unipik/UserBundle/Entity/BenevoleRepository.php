<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 22/09/16
 * Time: 09:00
 */

namespace Unipik\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\QueryBuilder;
use OpsWay\Doctrine\ORM\Query\AST\Functions\Contains;

/**
 * Class BenevoleRepository
 *
 * @package Unipik\UserBundle\Entity
 */
class BenevoleRepository extends EntityRepository
{
    /**
     * Generic function for DB queries.
     *
     * @param  $field
     * @param  $desc
     * @return array
     */

    public function getType($field, $desc, $ville){
        $qb = $this->createQueryBuilder('b');

        if($ville) {
            $this->whereVilleIs($qb, $ville);
        }

        if($field=="nom") {
            if($desc) {
                $qb = $qb->orderBy('b.nom', 'DESC');
            }else{
                $qb = $qb->orderBy('b.nom', 'ASC');
            }
        }
        else{
            if($desc) {
                $qb = $qb->orderBy('b.prenom', 'DESC');
            }else{
                $qb = $qb->orderBy('b.prenom', 'ASC');
            }
        }

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
         * @param $ville
         * @return array
         */
    public function getBenevoles($ville){
        $qb = $this->createQueryBuilder('b');

        //        if(!empty($act)){
        //            $this->getBenevolesByActivites($qb, $act);
        //        }
        //
        //        if(!empty($resp)){
        //            $this->getBenevolesByResponsabilites($qb, $act);
        //        }

        if($ville) {
            $this->whereVilleIs($qb, $ville);
        }

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * @param QueryBuilder $qb
     * @param $act
     */
    public function getBenevolesByActivites(QueryBuilder $qb, $act){
        $qb
            ->andWhere('b.activitePotentielle @> array_append(ARRAY[]::type_activite[],:a)')
            ->setParameter('a', '('.$act[0].')');

        for($i = 1; $i < (count($act)-1); $i+=1){
            $qb
                ->andWhere('b.activitePotentielle @> array_append(ARRAY[]::type_activite[],:a)')
                ->setParameter('a', '('.$act[$i].')');
        }

    }

    /**
     * @param QueryBuilder $qb
     * @param $resp
     */
    public function getBenevolesByResponsabilites(QueryBuilder $qb, $resp){
        $qb
            ->andWhere('b.responsabiliteActivite @> array_append(ARRAY[]::type_responsabilite_activite[],:a)')
            ->setParameter('a', '('.$resp[0].')');

        for($i = 1; $i < (count($resp)-1); $i+=1){
            $qb
                ->andWhere('b.responsabiliteActivite @> array_append(ARRAY[]::type_responsabilite_activite[],:a)')
                ->setParameter('a', '('.$resp[$i].')');
        }

    }

    /**
     * @param QueryBuilder $qb
     * @param $ville
     */
    public function whereVilleIs(QueryBuilder $qb, $ville) {
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
