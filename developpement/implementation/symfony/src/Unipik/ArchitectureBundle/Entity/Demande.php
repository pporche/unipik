<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\DemandeRepository")
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
    * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Contact")
    * @ORM\JoinColumn(nullable=false)
    */
    private $_contact;

    /**
    * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\MomentHebdomadaire", cascade={"persist"})
    * @ORM\JoinTable(name="demande_moments_voulus")
    */
    private $_momentsVoulus;

    /**
    * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\MomentHebdomadaire", cascade={"persist"})
    *@ORM\JoinTable(name="demande_moments_a_eviter")
    */
    private $_mommentsAEviter;

	
     /**
    * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Semaine", cascade={"persist"})
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
     * @param \CoreBundle\Entity\Contact $contact
     *
     * @return Demande
     */
    public function setContact(\CoreBundle\Entity\Contact $contact) {
        $this->_contact = $contact;
        return $this;
    }

    /**
     * Get contact
     *
     * @return \CoreBundle\Entity\Contact
     */
    public function getContact() {
        return $this->_contact;
    }

    /**
     * Add momentsVoulus
     *
     * @param \CoreBundle\Entity\MomentHebdomadaire $momentsVoulus
     *
     * @return Demande
     */
    public function addMomentsVoulus(\CoreBundle\Entity\MomentHebdomadaire $momentsVoulus) {
        $this->_momentsVoulus[] = $momentsVoulus;
        return $this;
    }

    /**
     * Remove momentsVoulus
     *
     * @param \CoreBundle\Entity\MomentHebdomadaire $momentsVoulus
     */
    public function removeMomentsVoulus(\CoreBundle\Entity\MomentHebdomadaire $momentsVoulus) {
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
     * @param \CoreBundle\Entity\MomentHebdomadaire $mommentsAEviter
     *
     * @return Demande
     */
    public function addMommentsAEviter(\CoreBundle\Entity\MomentHebdomadaire $mommentsAEviter) {
        $this->_mommentsAEviter[] = $mommentsAEviter;
        return $this;
    }

    /**
     * Remove mommentsAEviter
     *
     * @param \CoreBundle\Entity\MomentHebdomadaire $mommentsAEviter
     */
    public function removeMommentsAEviter(\CoreBundle\Entity\MomentHebdomadaire $mommentsAEviter) {
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
     * @param \CoreBundle\Entity\Semaine $listesemaine
     *
     * @return Demande
     */
    public function addListesemaine(\CoreBundle\Entity\Semaine $listesemaine) {
        $this->_listesemaine[] = $listesemaine;

        return $this;
    }

    /**
     * Remove listesemaine
     *
     * @param \CoreBundle\Entity\Semaine $listesemaine
     */
    public function removeListesemaine(\CoreBundle\Entity\Semaine $listesemaine) {
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
