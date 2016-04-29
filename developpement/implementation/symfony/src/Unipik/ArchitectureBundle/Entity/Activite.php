<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Unipik\ArchitectureBundle\DBAL\Types\ActiviteType;

/**
 * Activite
 * @ORM\Entity
 * @ORM\Table(name="activite")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\ActiviteRepository")
 */
class Activite {

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
     *
     *
     * @ORM\Column(name="activite", type="ActiviteType")
     * @DoctrineAssert\Enum(entity="Unipik\ArchitectureBundle\DBAL\Types\ActiviteType")
     */
    private $_activite;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set activite
     *
     * @param ActiviteType $activite
     *
     * @return Activite
     */
    public function setActivite($activite) {
        $this->_activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return ActiviteType
     */
    public function getActivite() {
        return $this->_activite;
    }

}
