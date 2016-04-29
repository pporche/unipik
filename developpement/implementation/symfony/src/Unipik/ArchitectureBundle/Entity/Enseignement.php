<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use CoreBundle\DBAL\Types\EnseignementType;
use CoreBundle\Entity\Etablissement;

/**
 * Enseignement
 *
 * @ORM\Table(name="enseignement")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\BenevoleRepository")
 */
class Enseignement extends Etablissement {
    
     /**
     * Note, that type of a field should be same as you set in Doctrine config
     *
     * @ORM\Column(name="type_enseignement", type="EnseignementType",nullable=false)
     * @DoctrineAssert\Enum(entity="CoreBundle\DBAL\Types\EnseignementType")     
     */
    private $_typeEnseignement;

    /**
     * Set typeEnseignement
     *
     * @param EnseignementType $typeEnseignement
     *
     * @return Enseignement
     */
    public function setTypeEnseignement($typeEnseignement) {
        $this->_typeEnseignement = $typeEnseignement;
        return $this;
    }

    /**
     * Get typeEnseignement
     *
     * @return EnseignementType
     */
    public function getTypeEnseignement() {
        return $this->_typeEnseignement;
    }
 
    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Enseignement
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
     * @return Enseignement
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
     * @return Enseignement
     */
    public function setEmails($emails) {
        $this->emails = $emails;
        return $this;
    }

    /**
     * Add adresse
     *
     * @param \CoreBundle\Entity\Adresse $adresse
     *
     * @return Enseignement
     */
    public function addAdresse(\CoreBundle\Entity\Adresse $adresse) {
        $this->adresse[] = $adresse;
        return $this;
    }

    /**
     * Add contact
     *
     * @param \CoreBundle\Entity\Contact $contact
     *
     * @return Enseignement
     */
    public function addContact(\CoreBundle\Entity\Contact $contact) {
        $this->contacts[] = $contact;
        return $this;
    }

    /**
     * Remove contact
     *
     * @param \CoreBundle\Entity\Contact $contact
     */
    public function removeContact(\CoreBundle\Entity\Contact $contact) {
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
     * @param \CoreBundle\Entity\Adresse $adresse
     *
     * @return Enseignement
     */
    public function setAdresse(\CoreBundle\Entity\Adresse $adresse) {
        $this->adresse = $adresse;

        return $this;
    }
}
