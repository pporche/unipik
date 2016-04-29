<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\ProjetRepository")
 */
class Projet {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $_id;

    /**
     * @var float
     *
     * @ORM\Column(name="chiffre_affaire", type="float", nullable=false)
     */
    private $_chiffreDaffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $_remarques;

    /**
     * @var TypeProjetType
     *
     * @ORM\Column(name="type", type="ProjetType", nullable=false)
     */
    private $_type;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=1000)
     */
    private $_nom;

    /**
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Benevole", cascade={"persist"})
     */
    private $_benevoles;

    /**
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Contact", cascade={"persist"})
     */
    private $_contacts;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set chiffreDaffaire
     *
     * @param float $chiffreDaffaire
     *
     * @return Projet
     */
    public function setChiffreDaffaire($chiffreDaffaire) {
        $this->chiffreDaffaire = $_chiffreDaffaire;

        return $this;
    }

    /**
     * Get chiffreDaffaire
     *
     * @return float
     */
    public function getChiffreDaffaire() {
        return $this->_chiffreDaffaire;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     *
     * @return Projet
     */
    public function setRemarques($remarques) {
        $this->_remarques = $remarques;

        return $this;
    }

    /**
     * Get remarques
     *
     * @return string
     */
    public function getRemarques() {
        return $this->_remarques;
    }

    /**
     * Set type
     *
     * @param ProjetType $type
     *
     * @return Projet
     */
    public function setType($type) {
        $this->_type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return ProjetType
     */
    public function getType() {
        return $this->_type;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Projet
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
     * Constructor
     */
    public function __construct() {
        $this->_benevoles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->_contacts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add benevole
     *
     * @param \Unipik\ArchitectureBundle\Entity\Benevole $benevole
     *
     * @return Projet
     */
    public function addBenevole(\Unipik\ArchitectureBundle\Entity\Benevole $benevole) {
        $this->_benevoles[] = $benevole;

        return $this;
    }

    /**
     * Remove benevole
     *
     * @param \Unipik\ArchitectureBundle\Entity\Benevole $benevole
     */
    public function removeBenevole(\Unipik\ArchitectureBundle\Entity\Benevole $benevole) {
        $this->_benevoles->removeElement($benevole);
    }

    /**
     * Get benevoles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBenevoles() {
        return $this->_benevoles;
    }

    /**
     * Add contact
     *
     * @param \Unipik\ArchitectureBundle\Entity\Contact $contact
     *
     * @return Projet
     */
    public function addContact(\Unipik\ArchitectureBundle\Entity\Contact $contact) {
        $this->_contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \Unipik\ArchitectureBundle\Entity\Contact $contact
     */
    public function removeContact(\Unipik\ArchitectureBundle\Entity\Contact $contact) {
        $this->_contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts() {
        return $this->_contacts;
    }
}
