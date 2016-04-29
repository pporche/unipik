<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comite
 *
 * @ORM\Table(name="comite")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\ComiteRepository")
 */
class Comite {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     *
     */
    private $_id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_departement", type="string", length=100, nullable=false)
     */
    private $_nomDepartement;

   /**
    * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Region")
    * @ORM\JoinColumn(nullable=false)
    */
    private $_region;

   /**
    * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\NiveauTheme")
    *
    */
    private $_listeNiveauTheme;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->_id;
    }

     /**
     * Set id
     *
     * @param integer $id
     *
     * @return Comite
     */
    public function setId($id) {
        $this->_id = $id;
        return $this;
    }

    /**
     * Set nomDepartement
     *
     * @param string $nomDepartement
     *
     * @return Comite
     */
    public function setNomDepartement($nomDepartement) {
        $this->_nomDepartement = $nomDepartement;
        return $this;
    }

    /**
     * Get nomDepartement
     *
     * @return string
     */
    public function getNomDepartement() {
        return $this->_nomDepartement;
    }

    /**
     * Set region
     *
     * @param \Unipik\ArchitectureBundle\Entity\Region $region
     *
     * @return Comite
     */
    public function setRegion(\Unipik\ArchitectureBundle\Entity\Region $region) {
        $this->_region = $region;
        return $this;
    }

    /**
     * Get region
     *
     * @return \Unipik\ArchitectureBundle\Entity\Region
     */
    public function getRegion() {
        return $this->_region;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->_listeNiveauTheme = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add listeNiveauTheme
     *
     * @param \Unipik\ArchitectureBundle\Entity\NiveauTheme $listeNiveauTheme
     *
     * @return Comite
     */
    public function addListeNiveauTheme(\Unipik\ArchitectureBundle\Entity\NiveauTheme $listeNiveauTheme) {
        $this->_listeNiveauTheme[] = $listeNiveauTheme;
        return $this;
    }

    /**
     * Remove listeNiveauTheme
     *
     * @param \Unipik\ArchitectureBundle\Entity\NiveauTheme $listeNiveauTheme
     */
    public function removeListeNiveauTheme(\Unipik\ArchitectureBundle\Entity\NiveauTheme $listeNiveauTheme) {
        $this->_listeNiveauTheme->removeElement($listeNiveauTheme);
    }

    /**
     * Get listeNiveauTheme
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListeNiveauTheme() {
        return $this->_listeNiveauTheme;
    }


}
