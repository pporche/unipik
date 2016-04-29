<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *Etablissement
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"enseignement" = "Enseignement","autre"="AutreEtablissement","centre"="CentreLoisirs"})
 *
 */
abstract class Etablissement {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="string", length=100)
     * @ORM\Id
     *
     */
    protected $id;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=true)
     */
    protected $nom;

    /**
     * @var string $telFixe
     *
     * @ORM\Column(name="tel_fixe", type="string", length=10, nullable=true)
     */
    protected $telFixe;

    /**
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Adresse", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $adresse;

     /**
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Contact", cascade={"persist"})
     *
     */
    protected $contacts;

    /**
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Email", cascade={"persist"})
     *
     */
    protected $emails;

      /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Get telFixe
     *
     * @return string
     */
    public function getTelFixe() {
        return $this->telFixe;
    }

    /**
     * Remove adresse
     *
     * @param \Unipik\ArchitectureBundle\Entity\Adresse $adresse
     */
    public function removeAdresse(\Unipik\ArchitectureBundle\Entity\Adresse $adresse) {
        $this->adresse->removeElement($adresse);
    }

    /**
     * Get adresse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresse() {
        return $this->adresse;
    }


    /**
     * Constructor
     */
    public function __construct() {
        $this->adresse = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emails = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Etablissement
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Set telFixe
     *
     * @param string $telFixe
     *
     * @return Etablissement
     */
    public function setTelFixe($telFixe) {
        $this->telFixe = $telFixe;

        return $this;
    }

    /**
     * Add adresse
     *
     * @param \Unipik\ArchitectureBundle\Entity\Adresse $adresse
     *
     * @return Etablissement
     */
    public function addAdresse(\Unipik\ArchitectureBundle\Entity\Adresse $adresse) {
        $this->adresse[] = $adresse;

        return $this;
    }

    /**
     * Add contact
     *
     * @param \Unipik\ArchitectureBundle\Entity\Contact $contact
     *
     * @return Etablissement
     */
    public function addContact(\Unipik\ArchitectureBundle\Entity\Contact $contact) {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \Unipik\ArchitectureBundle\Entity\Contact $contact
     */
    public function removeContact(\Unipik\ArchitectureBundle\Entity\Contact $contact) {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts() {
        return $this->contacts;
    }

    /**
     * Add email
     *
     * @param \Unipik\ArchitectureBundle\Entity\Email $email
     *
     * @return Etablissement
     */
    public function addEmail(\Unipik\ArchitectureBundle\Entity\Email $email) {
        $this->emails[] = $email;

        return $this;
    }

    /**
     * Remove email
     *
     * @param \Unipik\ArchitectureBundle\Entity\Email $email
     */
    public function removeEmail(\Unipik\ArchitectureBundle\Entity\Email $email) {
        $this->emails->removeElement($email);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails() {
        return $this->emails;
    }
}
