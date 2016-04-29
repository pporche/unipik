<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participe
 *
 * @ORM\Table(name="participe")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\ParticipeRepository")
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
    * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Projet")
    * @ORM\JoinColumn(nullable=false)
    */
    private $_projet;


    /**
    * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Contact")
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
     * @param \Unipik\ArchitectureBundle\Entity\Projet $projet
     *
     * @return Participe
     */
    public function setProjet(\Unipik\ArchitectureBundle\Entity\Projet $projet) {
        $this->_projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \Unipik\ArchitectureBundle\Entity\Projet
     */
    public function getProjet() {
        return $this->_projet;
    }

    /**
     * Set contact
     *
     * @param \Unipik\ArchitectureBundle\Entity\Contact $contact
     *
     * @return Participe
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
}
