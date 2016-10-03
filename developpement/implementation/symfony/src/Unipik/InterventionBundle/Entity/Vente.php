<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vente
 *
 * @ORM\Table(name="vente", indexes={@ORM\Index(name="IDX_888A2A4C8EAE3863", columns={"intervention_id"}), @ORM\Index(name="IDX_888A2A4CFF631228", columns={"etablissement_id"})})
 * @ORM\Entity
 */
class Vente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="vente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="chiffre_affaire", type="float", precision=10, scale=0, nullable=false)
     */
    private $chiffreAffaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_vente", type="date", nullable=false)
     */
    private $dateVente;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="string", length=500, nullable=true)
     */
    private $remarques;

    /**
     * @var \Unipik\ArchitectureBundle\Entity\Intervention
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Intervention")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_id", referencedColumnName="id")
     * })
     */
    private $intervention;

    /**
     * @var \Unipik\ArchitectureBundle\Entity\Etablissement
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Etablissement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etablissement_id", referencedColumnName="id")
     * })
     */
    private $etablissement;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set chiffreAffaire
     *
     * @param float $chiffreAffaire
     *
     * @return Vente
     */
    public function setChiffreAffaire($chiffreAffaire)
    {
        $this->chiffreAffaire = $chiffreAffaire;

        return $this;
    }

    /**
     * Get chiffreAffaire
     *
     * @return float
     */
    public function getChiffreAffaire()
    {
        return $this->chiffreAffaire;
    }

    /**
     * Set date de vente
     *
     * @param \DateTime $date
     *
     * @return Vente
     */
    public function setDateVente($date)
    {
        $this->dateVente = $date;

        return $this;
    }

    /**
     * Get date de vente
     *
     * @return \DateTime
     */
    public function getDateVente()
    {
        return $this->dateVente;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     *
     * @return Vente
     */
    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;

        return $this;
    }

    /**
     * Get remarques
     *
     * @return string
     */
    public function getRemarques()
    {
        return $this->remarques;
    }

    /**
     * Set intervention
     *
     * @param \Unipik\ArchitectureBundle\Entity\Intervention $intervention
     *
     * @return Vente
     */
    public function setIntervention(\Unipik\ArchitectureBundle\Entity\Intervention $intervention = null)
    {
        $this->intervention = $intervention;

        return $this;
    }

    /**
     * Get intervention
     *
     * @return \Unipik\ArchitectureBundle\Entity\Intervention
     */
    public function getIntervention()
    {
        return $this->intervention;
    }

    /**
     * Set etablissement
     *
     * @param \Unipik\ArchitectureBundle\Entity\Etablissement $etablissement
     *
     * @return Vente
     */
    public function setEtablissement(\Unipik\ArchitectureBundle\Entity\Etablissement $etablissement)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \Unipik\ArchitectureBundle\Entity\Etablissement
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }
}
