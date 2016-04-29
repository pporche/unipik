<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Unipik\ArchitectureBundle\DBAL\Types\ContactType;
use Unipik\ArchitectureBundle\Entity\Personne;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\ContactRepository")
 */
class Contact extends Personne {

     /**
     * Note, that type of a field should be same as you set in Doctrine config
     *
     * @ORM\Column(name="type_contact", type="ContactType", nullable=false)
     * @DoctrineAssert\Enum(entity="Unipik\ArchitectureBundle\DBAL\Types\ContactType")
     */
    private $_typeContact;

    /**
     * Set typeContact
     *
     * @param ContactType $typeContact
     *
     * @return Contact
     */
    public function setTypeContact($typeContact) {
        $this->_typeContact = $typeContact;
        return $this;
    }

    /**
     * Get typeContact
     *
     * @return ContactType
     */
    public function getTypeContact() {
        return $this->_typeContact;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Contact
     */
    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Contact
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * Set telFixe
     *
     * @param string $telFixe
     *
     * @return Contact
     */
    public function setTelFixe($telFixe) {
        $this->telFixe = $telFixe;
        return $this;
    }

    /**
     * Set telPortable
     *
     * @param string $telPortable
     *
     * @return Contact
     */
    public function setTelPortable($telPortable) {
        $this->telPortable = $telPortable;
        return $this;
    }
}
