<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participe
 *
 * @ORM\Table(name="participe")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ParticipeRepository")
 */
class Participe {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $_id;

    /**
     * @var bool
     *
     * @ORM\Column(name="est_tuteur", type="boolean", nullable=false)
     */
    private $_estTuteur;
    
   /**
    * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Projet")
    * @ORM\JoinColumn(nullable=false)
    */
    private $_projet;


    /**
    * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Contact")
    * @ORM\JoinColumn(nullable=false)
    */
    private $_contact;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set estTuteur
     *
     * @param boolean $estTuteur
     *
     * @return Participe
     */
    public function setEstTuteur($estTuteur) {
        $this->_estTuteur = $estTuteur;

        return $this;
    }

    /**
     * Get estTuteur
     *
     * @return bool
     */
    public function getEstTuteur() {
        return $this->_estTuteur;
    }

    /**
     * Set projet
     *
     * @param \CoreBundle\Entity\Projet $projet
     *
     * @return Participe
     */
    public function setProjet(\CoreBundle\Entity\Projet $projet) {
        $this->_projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \CoreBundle\Entity\Projet
     */
    public function getProjet() {
        return $this->_projet;
    }

    /**
     * Set contact
     *
     * @param \CoreBundle\Entity\Contact $contact
     *
     * @return Participe
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
}
