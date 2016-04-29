<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\DemandeRepository")
 */
class Demande {

    /**
    * @var int
    *
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $_id;

    /**
    * @var \DateTime
    *
    * @ORM\Column(name="date", type="date", nullable=false)
    */
    private $_date;

    /**
    * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Contact")
    * @ORM\JoinColumn(nullable=false)
    */
    private $_contact;

    /**
    * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\MomentHebdomadaire", cascade={"persist"})
    * @ORM\JoinTable(name="demande_moments_voulus")
    */
    private $_momentsVoulus;

    /**
    * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\MomentHebdomadaire", cascade={"persist"})
    *@ORM\JoinTable(name="demande_moments_a_eviter")
    */
    private $_mommentsAEviter;


     /**
    * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Semaine", cascade={"persist"})
    *
    */
    private $_listesemaine;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

     /**
     * Constructor
     */
    public function __construct() {
        $this->_momentsVoulus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->_mommentsAEviter = new \Doctrine\Common\Collections\ArrayCollection();
	$this->_listesemaine = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Demande
     */
    public function setDate($date) {
        $this->_date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->_date;
    }

    /**
     * Set contact
     *
     * @param \Unipik\ArchitectureBundle\Entity\Contact $contact
     *
     * @return Demande
     */
    public function setContact(\Unipik\ArchitectureBundle\Entity\Contact $contact) {
        $this->_contact = $contact;
        return $this;
    }

    /**
     * Get contact
     *
     * @return \Unipik\ArchitectureBundle\Entity\Contact
     */
    public function getContact() {
        return $this->_contact;
    }

    /**
     * Add momentsVoulus
     *
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsVoulus
     *
     * @return Demande
     */
    public function addMomentsVoulus(\Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsVoulus) {
        $this->_momentsVoulus[] = $momentsVoulus;
        return $this;
    }

    /**
     * Remove momentsVoulus
     *
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsVoulus
     */
    public function removeMomentsVoulus(\Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsVoulus) {
        $this->_momentsVoulus->removeElement($momentsVoulus);
    }

    /**
     * Get momentsVoulus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMomentsVoulus() {
        return $this->_momentsVoulus;
    }

    /**
     * Add mommentsAEviter
     *
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $mommentsAEviter
     *
     * @return Demande
     */
    public function addMommentsAEviter(\Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $mommentsAEviter) {
        $this->_mommentsAEviter[] = $mommentsAEviter;
        return $this;
    }

    /**
     * Remove mommentsAEviter
     *
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $mommentsAEviter
     */
    public function removeMommentsAEviter(\Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $mommentsAEviter) {
        $this->_mommentsAEviter->removeElement($mommentsAEviter);
    }

    /**
     * Get mommentsAEviter
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMommentsAEviter() {
        return $this->_mommentsAEviter;
    }

    /**
     * Add listesemaine
     *
     * @param \Unipik\ArchitectureBundle\Entity\Semaine $listesemaine
     *
     * @return Demande
     */
    public function addListesemaine(\Unipik\ArchitectureBundle\Entity\Semaine $listesemaine) {
        $this->_listesemaine[] = $listesemaine;

        return $this;
    }

    /**
     * Remove listesemaine
     *
     * @param \Unipik\ArchitectureBundle\Entity\Semaine $listesemaine
     */
    public function removeListesemaine(\Unipik\ArchitectureBundle\Entity\Semaine $listesemaine) {
        $this->_listesemaine->removeElement($listesemaine);
    }

    /**
     * Get listesemaine
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListesemaine() {
        return $this->_listesemaine;
    }
}
