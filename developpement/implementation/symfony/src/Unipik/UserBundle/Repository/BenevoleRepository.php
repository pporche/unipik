<?php
use Doctrine\ORM\EntityRepository;

class BenevoleRepository extends EntityRepository {

    /**
     * @param $field
     * @param $desc
     * @return mixed
     */
    public function getType($field, $desc){
        $qb = $this->findAll();

        if($field=="nom"){
            if($desc){
                $qb = $this->findBy(
                    array('numberrange' => $field),
                    array('numberrange' => 'desc')
                );
            }else{
                $qb = $this->findBy(
                    array('numberrange' => $field),
                    array('numberrange' => 'asc')
                );
            }
        }

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

}