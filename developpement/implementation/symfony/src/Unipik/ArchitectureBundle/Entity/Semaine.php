<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Semaine
 *
 * @ORM\Table(name="semaine")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\SemaineRepository")
 *
 *
 */
class Semaine {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     *
     */
    private $_id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Semaine
     */
    public function setId($id)
    {
        $this->_id = $id;

        return $this;
    }
}
