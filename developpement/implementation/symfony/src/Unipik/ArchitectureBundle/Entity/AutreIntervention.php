<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use CoreBundle\DBAL\Types\ActiviteType;
use CoreBundle\Entity\Intervention;

/**
 * AutreIntervention
 *
 * @ORM\Table(name="autre_intervention")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\AutreInterventionRepository")
 */
class AutreIntervention extends Intervention {
    
    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text",nullable=false)
     */
    private $_description;


    /**
     * Set description
     *
     * @param string $description
     *
     * @return AutreIntervention
     */
    public function setDescription($description) {
        $this->_description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->_description;
    }

    /**
     * Set demande
     *
     * @param \CoreBundle\Entity\Demande $demande
     *
     * @return AutreIntervention
     */
    public function setDemande(\CoreBundle\Entity\Demande $demande) {
        $this->demande = $demande;

        return $this;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return AutreIntervention
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
     * @return AutreIntervention
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
     * @return AutreIntervention
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
     * @return AutreIntervention
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
     * @return AutreIntervention
     */
    public function setMoment($moment) {
        $this->moment = $moment;

        return $this;
    }

    /**
     * Set vente
     *
     * @param \CoreBundle\Entity\Vente $vente
     *
     * @return AutreIntervention
     */
    public function setVente(\CoreBundle\Entity\Vente $vente) {
        $this->vente = $vente;

        return $this;
    }

    /**
     * Get vente
     *
     * @return \CoreBundle\Entity\Vente
     */
    public function getVente() {
        return $this->vente;
    }

    /**
     * Set benevole
     *
     * @param \CoreBundle\Entity\Benevole $benevole
     *
     * @return AutreIntervention
     */
    public function setBenevole(\CoreBundle\Entity\Benevole $benevole = null) {
        $this->benevole = $benevole;

        return $this;
    }

    /**
     * Set comite
     *
     * @param \CoreBundle\Entity\Comite $comite
     *
     * @return AutreIntervention
     */
    public function setComite(\CoreBundle\Entity\Comite $comite) {
        $this->comite = $comite;

        return $this;
    }

    /**
     * Set etablissement
     *
     * @param \CoreBundle\Entity\Etablissement $etablissement
     *
     * @return AutreIntervention
     */
    public function setEtablissement(\CoreBundle\Entity\Etablissement $etablissement) {
        $this->etablissement = $etablissement;

        return $this;
    }
}
