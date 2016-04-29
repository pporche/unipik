<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\RegionRepository")
 */
class Region {

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="string", length=100, unique=true)
     */
    private $_nom;

   /**
    * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Pays")
    * @ORM\JoinColumn(nullable=false)
    */
   private $_pays;

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Region
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

    /**
     * Set pays
     *
     * @param \Unipik\ArchitectureBundle\Entity\Pays $pays
     *
     * @return Region
     */
    public function setPays(\Unipik\ArchitectureBundle\Entity\Pays $pays) {
        $this->_pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \Unipik\ArchitectureBundle\Entity\Pays
     */
    public function getPays() {
        return $this->_pays;
    }

}
