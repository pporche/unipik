<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Unipik\ArchitectureBundle\DBAL\Types\CentreType;
use Unipik\ArchitectureBundle\Entity\Etablissement;

/**
 * CentreLoisirs
 *
 * @ORM\Table(name="centre_loisirs")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\CentreLoisirsRepository")
 */
class CentreLoisirs extends Etablissement {

     /**
     * Note, that type of a field should be same as you set in Doctrine config
     *
     * @ORM\Column(name="type_centre", type="CentreType", nullable=false)
     * @DoctrineAssert\Enum(entity="Unipik\ArchitectureBundle\DBAL\Types\CentreType")
     */
    private $_typeCentre;

    /**
     * Set typeCentre
     *
     * @param CentreType $typeCentre
     *
     * @return CentreLoisirs
     */
    public function setTypeCentre($typeCentre) {
        $this->_typeCentre = $typeCentre;
        return $this;
    }

    /**
     * Get typeCentre
     *
     * @return CentreType
     */
    public function getTypeCentre() {
        return $this->_typeCentre;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return CentreLoisirs
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
     * @return CentreLoisirs
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
     * @return CentreLoisirs
     */
    public function setEmails($emails) {
        $this->emails = $emails;
        return $this;
    }

    /**
     * Add contact
     *
     * @param \Unipik\ArchitectureBundle\Entity\Contact $contact
     *
     * @return CentreLoisirs
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
     * @return CentreLoisirs
     */
    public function setAdresse(\Unipik\ArchitectureBundle\Entity\Adresse $adresse) {
        $this->adresse = $adresse;

        return $this;
    }
}
