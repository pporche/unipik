<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 22/09/16
 * Time: 09:00
 */

namespace Unipik\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class BenevoleRepository extends EntityRepository
{
    /**
     * @param $field
     * @param $desc
     * @return mixed
     */
    public function getType($field, $desc){
        $qb = $this->findAll();
        if($field=="nom"){
            if($desc){
                $qb->orderBy('e.nom','DESC');
            }else{
                $qb->orderBy('e.nom','ASC');
            }
        }

        return $qb;
    }
}
