<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Unipik\ArchitectureBundle\DBAL\Types\MaterielPlaidoyerType;
use Unipik\ArchitectureBundle\Entity\NiveauTheme;
use Unipik\ArchitectureBundle\Entity\Intervention;

/**
 * Plaidoyer
 *
 * @ORM\Table(name="plaidoyer")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\PlaidoyerRepository")
 */
class Plaidoyer extends Intervention {
     /**
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\MaterielPlaidoyer", cascade={"persist"})
     *
     */
    private $_materielDispo;

     /**
      * @ORM\OneToOne(targetEntity="Unipik\ArchitectureBundle\Entity\NiveauTheme", cascade={"persist"})
      * @ORM\JoinColumn(nullable=false)
      */
    private $_niveauTheme;


    /**
     * Constructor
     */
    public function __construct() {
        $this->_materielDispo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set niveauTheme
     *
     * @param \Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme
     *
     * @return Plaidoyer
     */
    public function setNiveauTheme(\Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme = null) {
        $this->_niveauTheme = $niveauTheme;

        return $this;
    }

    /**
     * Get niveauTheme
     *
     * @return \Unipik\ArchitectureBundle\Entity\NiveauTheme
     */
    public function getNiveauTheme() {
        return $this->_niveauTheme;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Plaidoyer
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
     * @return Plaidoyer
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
     * @return Plaidoyer
     */
    public function setNbPersonne($nbPersonne) {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     *
     * @return Plaidoyer
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
     * @return Plaidoyer
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
     * @return Plaidoyer
     */
    public function setDemande(\Unipik\ArchitectureBundle\Entity\Demande $demande) {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Add materielDispo
     *
     * @param \Unipik\ArchitectureBundle\Entity\MaterielPlaidoyer $materielDispo
     *
     * @return Plaidoyer
     */
    public function addMaterielDispo(\Unipik\ArchitectureBundle\Entity\MaterielPlaidoyer $materielDispo) {
        $this->_materielDispo[] = $materielDispo;

        return $this;
    }

    /**
     * Remove materielDispo
     *
     * @param \Unipik\ArchitectureBundle\Entity\MaterielPlaidoyer $materielDispo
     */
    public function removeMaterielDispo(\Unipik\ArchitectureBundle\Entity\MaterielPlaidoyer $materielDispo)
    {
        $this->_materielDispo->removeElement($materielDispo);
    }

    /**
     * Get materielDispo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMaterielDispo()
    {
        return $this->_materielDispo;
    }

    /**
     * Set comite
     *
     * @param \Unipik\ArchitectureBundle\Entity\Comite $comite
     *
     * @return Plaidoyer
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
     * @return Plaidoyer
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
     * @return Plaidoyer
     */
    public function setBenevole(\Unipik\ArchitectureBundle\Entity\Benevole $benevole = null) {
        $this->benevole = $benevole;

        return $this;
    }
}
