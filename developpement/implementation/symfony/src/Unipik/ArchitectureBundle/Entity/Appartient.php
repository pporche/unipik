<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Unipik\ArchitectureBundle\DBAL\Types\ActiviteType;

/**
 * Appartient
 *
 * @ORM\Table(name="appartient")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\AppartientRepository")
 */
class Appartient {

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
     * @ORM\Column(name="respo_etablissement", type="boolean")
     */
    private $_respoEtablissement;


    /**
    * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Etablissement")
    * @ORM\JoinColumn(nullable=false)
    */
    private $_etablissement;


    /**
    * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Contact")
    * @ORM\JoinColumn(nullable=false)
    */

    private $_contact;

     /**
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Activite", cascade={"persist"})
     *
     */
    private $_typeActivite;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set respoEtablissement
     *
     * @param boolean $respoEtablissement
     *
     * @return Appartient
     */
    public function setRespoEtablissement($respoEtablissement) {
        $this->_respoEtablissement = $respoEtablissement;

        return $this;
    }

    /**
     * Get respoEtablissement
     *
     * @return bool
     */
    public function getRespoEtablissement() {
        return $this->_respoEtablissement;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->_typeActivite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set etablissement
     *
     * @param \Unipik\ArchitectureBundle\Entity\Etablissement $etablissement
     *
     * @return Appartient
     */
    public function setEtablissement(\Unipik\ArchitectureBundle\Entity\Etablissement $etablissement) {
        $this->_etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \Unipik\ArchitectureBundle\Entity\Etablissement
     */
    public function getEtablissement() {
        return $this->etablissement;
    }

    /**
     * Set contact
     *
     * @param \Unipik\ArchitectureBundle\Entity\Contact $contact
     *
     * @return Appartient
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
     * Add typeActivite
     *
     * @param \Unipik\ArchitectureBundle\DBAL\Types\ActiviteType $typeActivite
     *
     * @return Appartient
     */
    public function addTypeActivite(\Unipik\ArchitectureBundle\DBAL\Types\ActiviteType $typeActivite) {
        $this->_typeActivite[] = $typeActivite;

        return $this;
    }

    /**
     * Remove typeActivite
     *
     * @param \Unipik\ArchitectureBundle\DBAL\Types\ActiviteType $typeActivite
     */
    public function removeTypeActivite(\Unipik\ArchitectureBundle\DBAL\Types\ActiviteType $typeActivite) {
        $this->_typeActivite->removeElement($typeActivite);
    }

    /**
     * Get typeActivite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypeActivite() {
        return $this->_typeActivite;
    }

}
