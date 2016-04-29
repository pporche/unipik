<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\PaysRepository")
 */
class Pays {

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="string", length=100, unique=true, nullable=false)
     */
    private $_nom;

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Pays
     */
    public function setNom($nom) {
        $this->_nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->_nom;
    }


}
