<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use CoreBundle\DBAL\Types\MaterielFrimousseType;

/**
 * MaterielFrimousse
 * @ORM\Entity
 * @ORM\Table(name="materiel_frimousse")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\MaterielFrimousseRepository")
 */
class MaterielFrimousse {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $_id;
    
     /**
     *
     * @ORM\Column(name="materiel_frimousse", type="MaterielFrimousseType")
     * @DoctrineAssert\Enum(entity="CoreBundle\DBAL\Types\MaterielFrimousseType") 
     */
    private $_materielFrimousse;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set materielFrimousse
     *
     * @param MaterielFrimousseType $materielFrimousse
     *
     * @return materielFrimousse
     */
    public function setMaterielFrimousse($materielFrimousse) {
        $this->_materielFrimousse = $materielFrimousse;

        return $this;
    }

    /**
     * Get materielFrimousse
     *
     * @return MaterielFrimousseType
     */
    public function getMaterielFrimousse() {
        return $this->_materielFrimousse;
    }
}
