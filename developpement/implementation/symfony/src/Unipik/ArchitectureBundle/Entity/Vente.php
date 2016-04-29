<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vente
 *
 * @ORM\Table(name="vente")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\VenteRepository")
 */
class Vente {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $_id;

    /**
     * @var float
     *
     * @ORM\Column(name="chiffre_affaire", type="float", nullable=false)
     */
    private $_chiffreDAffaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $_date;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $_remarques;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Etablissement")
     * @ORM\JoinColumn(nullable=false)
     */
     private $_etablissement;

     /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Intervention")
     * @ORM\JoinColumn(nullable=true)
     */
     private $_intervention;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set chiffreDAffaire
     *
     * @param float $chiffreDAffaire
     *
     * @return Vente
     */
    public function setChiffreDAffaire($chiffreDAffaire) {
        $this->_chiffreDAffaire = $chiffreDAffaire;

        return $this;
    }

    /**
     * Get chiffreDAffaire
     *
     * @return float
     */
    public function getChiffreDAffaire() {
        return $this->_chiffreDAffaire;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Vente
     */
    public function setDate($date) {
        $this->_date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->_date;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     *
     * @return Vente
     */
    public function setRemarques($remarques) {
        $this->_remarques = $remarques;

        return $this;
    }

    /**
     * Get remarques
     *
     * @return string
     */
    public function getRemarques() {
        return $this->_remarques;
    }

    /**
     * Set etablissement
     *
     * @param \CoreBundle\Entity\Etablissement $etablissement
     *
     * @return Vente
     */
    public function setEtablissement(\CoreBundle\Entity\Etablissement $etablissement) {
        $this->_etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \CoreBundle\Entity\Etablissement
     */
    public function getEtablissement() {
        return $this->_etablissement;
    }

    /**
     * Set intervention
     *
     * @param \CoreBundle\Entity\Intervention $intervention
     *
     * @return Vente
     */
    public function setIntervention(\CoreBundle\Entity\Intervention $intervention = null) {
        $this->_intervention = $intervention;

        return $this;
    }

    /**
     * Get intervention
     *
     * @return \CoreBundle\Entity\Intervention
     */
    public function getIntervention() {
        return $this->_intervention;
    }
}
