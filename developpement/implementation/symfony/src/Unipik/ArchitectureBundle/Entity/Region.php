<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\RegionRepository")
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
    * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Pays")
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
     * @param \CoreBundle\Entity\Pays $pays
     *
     * @return Region
     */
    public function setPays(\CoreBundle\Entity\Pays $pays) {
        $this->_pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \CoreBundle\Entity\Pays
     */
    public function getPays() {
        return $this->_pays;
    }

}
