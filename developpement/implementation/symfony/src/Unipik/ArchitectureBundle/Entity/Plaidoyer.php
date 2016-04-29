<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use CoreBundle\DBAL\Types\MaterielPlaidoyerType;
use CoreBundle\Entity\NiveauTheme;
use CoreBundle\Entity\Intervention;

/**
 * Plaidoyer
 *
 * @ORM\Table(name="plaidoyer")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PlaidoyerRepository")
 */
class Plaidoyer extends Intervention {
     /**
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\MaterielPlaidoyer", cascade={"persist"})
     * 
     */
    private $_materielDispo;

     /**
      * @ORM\OneToOne(targetEntity="CoreBundle\Entity\NiveauTheme", cascade={"persist"})
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
     * @param \CoreBundle\Entity\NiveauTheme $niveauTheme
     *
     * @return Plaidoyer
     */
    public function setNiveauTheme(\CoreBundle\Entity\NiveauTheme $niveauTheme = null) {
        $this->_niveauTheme = $niveauTheme;

        return $this;
    }

    /**
     * Get niveauTheme
     *
     * @return \CoreBundle\Entity\NiveauTheme
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
     * @param \CoreBundle\Entity\Demande $demande
     *
     * @return Plaidoyer
     */
    public function setDemande(\CoreBundle\Entity\Demande $demande) {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Add materielDispo
     *
     * @param \CoreBundle\Entity\MaterielPlaidoyer $materielDispo
     *
     * @return Plaidoyer
     */
    public function addMaterielDispo(\CoreBundle\Entity\MaterielPlaidoyer $materielDispo) {
        $this->_materielDispo[] = $materielDispo;

        return $this;
    }

    /**
     * Remove materielDispo
     *
     * @param \CoreBundle\Entity\MaterielPlaidoyer $materielDispo
     */
    public function removeMaterielDispo(\CoreBundle\Entity\MaterielPlaidoyer $materielDispo)
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
     * @param \CoreBundle\Entity\Comite $comite
     *
     * @return Plaidoyer
     */
    public function setComite(\CoreBundle\Entity\Comite $comite) {
        $this->comite = $comite;

        return $this;
    }

    /**
     * Get comite
     *
     * @return \CoreBundle\Entity\Comite
     */
    public function getComite() {
        return $this->comite;
    }

    /**
     * Set etablissement
     *
     * @param \CoreBundle\Entity\Etablissement $etablissement
     *
     * @return Plaidoyer
     */
    public function setEtablissement(\CoreBundle\Entity\Etablissement $etablissement) {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \CoreBundle\Entity\Etablissement
     */
    public function getEtablissement() {
        return $this->etablissement;
    }

    /**
     * Set benevole
     *
     * @param \CoreBundle\Entity\Benevole $benevole
     *
     * @return Plaidoyer
     */
    public function setBenevole(\CoreBundle\Entity\Benevole $benevole = null) {
        $this->benevole = $benevole;

        return $this;
    }
}
