<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Unipik\ArchitectureBundle\DBAL\Types\MaterielFrimousseType;
use Unipik\ArchitectureBundle\DBAL\Types\NiveauScolaireLimiteType;
use Unipik\ArchitectureBundle\Entity\Intervention;

/**
 * Frimousse
 *
 * @ORM\Table(name="frimousse")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\FrimousseRepository")
 */
class Frimousse extends Intervention {

    /**
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\MaterielFrimousse", cascade={"persist"})
     *
     */
    private $_materiaux;

    /**
     *
     * @ORM\Column(name="niveau", type="NiveauScolaireLimiteType")
     * @DoctrineAssert\Enum(entity="Unipik\ArchitectureBundle\DBAL\Types\NiveauScolaireLimiteType")
     *
     */
    private $_niveau;

    /**
     * Set niveau
     *
     * @param NiveauScolaireLimiteType $niveau
     *
     * @return Frimousse
     */
    public function setNiveau($niveau) {
        $this->_niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return NiveauScolaireLimiteType
     */
    public function getNiveau() {
        return $this->_niveau;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Frimousse
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Frimousse
     */
    public function setLieu($lieu) {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Set nbPersonne
     *
     * @param integer $nbPersonne
     *
     * @return Frimousse
     */
    public function setNbPersonne($nbPersonne) {
        $this->_nbPersonne = $nbPersonne;

        return $this;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     *
     * @return Frimousse
     */
    public function setRemarques($remarques) {
        $this->remarques = $remarques;

        return $this;
    }

    /**
     * Set moment
     *
     * @param MomentQuotidienType $moment
     *
     * @return Frimousse
     */
    public function setMoment($moment) {
        $this->moment = $moment;

        return $this;
    }

    /**
     * Set demande
     *
     * @param \Unipik\ArchitectureBundle\Entity\Demande $demande
     *
     * @return Frimousse
     */
    public function setDemande(\Unipik\ArchitectureBundle\Entity\Demande $demande) {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->_materiaux = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add materiaux
     *
     * @param \Unipik\ArchitectureBundle\Entity\MaterielFrimousse $materiaux
     *
     * @return Frimousse
     */
    public function addMateriaux(\Unipik\ArchitectureBundle\Entity\MaterielFrimousse $materiaux) {
        $this->_materiaux[] = $materiaux;

        return $this;
    }

    /**
     * Remove materiaux
     *
     * @param \Unipik\ArchitectureBundle\Entity\MaterielFrimousse $materiaux
     */
    public function removeMateriaux(\Unipik\ArchitectureBundle\Entity\MaterielFrimousse $materiaux) {
        $this->_materiaux->removeElement($materiaux);
    }

    /**
     * Get materiaux
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMateriaux() {
        return $this->_materiaux;
    }

    /**
     * Set comite
     *
     * @param \Unipik\ArchitectureBundle\Entity\Comite $comite
     *
     * @return Frimousse
     */
    public function setComite(\Unipik\ArchitectureBundle\Entity\Comite $comite) {
        $this->comite = $comite;

        return $this;
    }

    /**
     * Get comite
     *
     * @return \Unipik\ArchitectureBundle\Entity\Comite
     */
    public function getComite() {
        return $this->comite;
    }

    /**
     * Set etablissement
     *
     * @param \Unipik\ArchitectureBundle\Entity\Etablissement $etablissement
     *
     * @return Frimousse
     */
    public function setEtablissement(\Unipik\ArchitectureBundle\Entity\Etablissement $etablissement) {
        $this->etablissement = $etablissement;

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
     * Set benevole
     *
     * @param \Unipik\ArchitectureBundle\Entity\Benevole $benevole
     *
     * @return Frimousse
     */
    public function setBenevole(\Unipik\ArchitectureBundle\Entity\Benevole $benevole = null) {
        $this->benevole = $benevole;

        return $this;
    }
}
