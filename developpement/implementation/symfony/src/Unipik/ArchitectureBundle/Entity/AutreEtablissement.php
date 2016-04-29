<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Unipik\ArchitectureBundle\Entity\Etablissement;
use Unipik\ArchitectureBundle\Entity\Vente;

/**
 * AutreEtablissement
 *
 * @ORM\Table(name="autre_etablissement")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\CentreLoisirsRepository")
 */
class AutreEtablissement extends Etablissement {

    /**
     * Note, that type of a field should be same as you set in Doctrine config
     *
     * @ORM\Column(name="type_autre_etablissement", type="AutreEtablissementType", nullable=false)
     * @DoctrineAssert\Enum(entity="Unipik\ArchitectureBundle\DBAL\Types\AutreEtablissementType")
     *
     */
    private $_typeAutreEtablissement;

    /**
     * Constructor
     */
    public function __construct() {
        $this->adresse = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return AutreEtablissement
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
     * @return AutreEtablissement
     */
    public function setTelFixe($telFixe) {
        $this->telFixe = $telFixe;

        return $this;
    }

    /**
     * Set emails
     *
     * @param string $emails
     *
     * @return AutreEtablissement
     */
    public function setEmails($emails) {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Add adresse
     *
     * @param \Unipik\ArchitectureBundle\Entity\Adresse $adresse
     *
     * @return AutreEtablissement
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
     * @return AutreEtablissement
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
     * Set adresse
     *
     * @param \Unipik\ArchitectureBundle\Entity\Adresse $adresse
     *
     * @return AutreEtablissement
     */
    public function setAdresse(\Unipik\ArchitectureBundle\Entity\Adresse $adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Set typeAutreEtablissement
     *
     * @param AutreEtablissementType $typeAutreEtablissement
     *
     * @return AutreEtablissement
     */
    public function setTypeAutreEtablissement($typeAutreEtablissement)
    {
        $this->_typeAutreEtablissement = $typeAutreEtablissement;

        return $this;
    }

    /**
     * Get typeAutreEtablissement
     *
     * @return AutreEtablissementType
     */
    public function getTypeAutreEtablissement() {
        return $this->_typeAutreEtablissement;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return AutreEtablissement
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }
}
