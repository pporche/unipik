<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervention
 * @ORM\Entity(repositoryClass="Unipik\InterventionBundle\Entity\InterventionRepository")
 * @ORM\Table(name="intervention", indexes={@ORM\Index(name="IDX_D11814ABE004B434", columns={"niveau_theme_id"}), @ORM\Index(name="IDX_D11814ABFF631228", columns={"etablissement_id"}), @ORM\Index(name="IDX_D11814ABD61C3573", columns={"comite_id"}), @ORM\Index(name="IDX_D11814ABE77B7C09", columns={"benevole_id"}), @ORM\Index(name="IDX_D11814AB80E95E18", columns={"demande_id"})})
 * @ORM\Entity
 */
class Intervention
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="intervention_id_seq", allocationSize=1, initialValue=1)
     */
    public $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_intervention", type="date", nullable=true)
     */
    public $dateIntervention;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=100, nullable=true)
     */
    public $lieu;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_personne", type="integer", nullable=false)
     */
    public $nbPersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="string", length=500 nullable=true)
     */
    public $remarques;

    /**
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=30, nullable=true)
     */
    public $heure;

    /**
     * @var boolean
     *
     * @ORM\Column(name="realisee", type="boolean", nullable=false)
     */
    public $realisee;


    /**
     * @var string
     *
     * @ORM\Column(name="materiel_dispo_plaidoyer", type="string", length=500, nullable=true)
     * @example : '{(enceinte},(autre)'
     */
    public $materielDispoPlaidoyer;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_frimousse", type="string", length=30, nullable=true)
     */
    public $niveauFrimousse;

    /**
     * @var string
     *
     * @ORM\Column(name="materiaux_frimousse", type="string", length=500, nullable=true)
     */
    public $materiauxFrimousse;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    public $description;

    /**
     * @var \Unipik\ArchitectureBundle\Entity\NiveauTheme
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\NiveauTheme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau_theme_id", referencedColumnName="id")
     * })
     */
    public $niveauTheme;

    /**
     * @var \Unipik\InterventionBundle\Entity\Etablissement
     *
     * @ORM\ManyToOne(targetEntity="Unipik\InterventionBundle\Entity\Etablissement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etablissement_id", referencedColumnName="id")
     * })
     */
    public $etablissement;

    /**
     * @var \Unipik\UserBundle\Entity\Comite
     *
     * @ORM\ManyToOne(targetEntity="Unipik\UserBundle\Entity\Comite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comite_id", referencedColumnName="id")
     * })
     */
    public $comite;

    /**
     * @var \Unipik\UserBundle\Entity\Benevole
     *
     * @ORM\ManyToOne(targetEntity="Unipik\UserBundle\Entity\Benevole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="benevole_id", referencedColumnName="id")
     * })
     */
    public $benevole;

    /**
     * @var \Unipik\InterventionBundle\Entity\Demande
     *
     * @ORM\ManyToOne(targetEntity="Unipik\InterventionBundle\Entity\Demande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="demande_id", referencedColumnName="id")
     * })
     */
    public $demande;



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
     * Set date d intervention
     *
     * @param \DateTime $date
     *
     * @return Intervention
     */
    public function setDateIntervention($date)
    {
        $this->dateIntervention = $date;

        return $this;
    }

    /**
     * Get date d intervention
     *
     * @return \DateTime
     */
    public function getDateIntervention()
    {
        return $this->dateIntervention;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Intervention
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set nbPersonne
     *
     * @param integer $nbPersonne
     *
     * @return Intervention
     */
    public function setNbPersonne($nbPersonne)
    {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    /**
     * Get nbPersonne
     *
     * @return integer
     */
    public function getNbPersonne()
    {
        return $this->nbPersonne;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     *
     * @return Intervention
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
     * Set heure
     *
     * @param string $heure
     *
     * @return Intervention
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }


    /**
     * Get heure
     *
     * @return string
     */
    public function getHeure()
    {
        return $this->heure;
    }


    /**
     * Set realisee
     *
     * @param boolean $realisee
     *
     * @return Intervention
     */
    public function setRealisee($realisee)
    {
        $this->realisee = $realisee;

        return $this;
    }


    /**
     * Get realisee
     *
     * @return boolean
     */
    public function getRealisee()
    {
        return $this->realisee;
    }


    /**
     * Set materielDispoPlaidoyer
     *
     * @param string $materielDispoPlaidoyer
     *
     * @return Intervention
     */
    public function setMaterielDispoPlaidoyer($materielDispoPlaidoyer)
    {
        $this->materielDispoPlaidoyer = $materielDispoPlaidoyer;

        return $this;
    }

    /**
     * Get materielDispoPlaidoyer
     *
     * @return string
     */
    public function getMaterielDispoPlaidoyer()
    {
        return $this->materielDispoPlaidoyer;
    }

    /**
     * Set niveauFrimousse
     *
     * @param string $niveauFrimousse
     *
     * @return Intervention
     */
    public function setNiveauFrimousse($niveauFrimousse)
    {
        $this->niveauFrimousse = $niveauFrimousse;

        return $this;
    }

    /**
     * Get niveauFrimousse
     *
     * @return string
     */
    public function getNiveauFrimousse()
    {
        return $this->niveauFrimousse;
    }

    /**
     * Set materiauxFrimousse
     *
     * @param string $materiauxFrimousse
     *
     * @return Intervention
     */
    public function setMateriauxFrimousse($materiauxFrimousse)
    {
        $this->materiauxFrimousse = $materiauxFrimousse;

        return $this;
    }

    /**
     * Get materiauxFrimousse
     *
     * @return string
     */
    public function getMateriauxFrimousse()
    {
        return $this->materiauxFrimousse;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Intervention
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set niveauTheme
     *
     * @param \Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme
     *
     * @return Intervention
     */
    public function setNiveauTheme(\Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme = null)
    {
        $this->niveauTheme = $niveauTheme;

        return $this;
    }

    /**
     * Get niveauTheme
     *
     * @return \Unipik\ArchitectureBundle\Entity\NiveauTheme
     */
    public function getNiveauTheme()
    {
        return $this->niveauTheme;
    }

    /**
     * Set etablissement
     *
     * @param \Unipik\InterventionBundle\Entity\Etablissement $etablissement
     *
     * @return Intervention
     */
    public function setEtablissement(\Unipik\InterventionBundle\Entity\Etablissement $etablissement)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \Unipik\InterventionBundle\Entity\Etablissement
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Set comite
     *
     * @param \Unipik\UserBundle\Entity\Comite $comite
     *
     * @return Intervention
     */
    public function setComite(\Unipik\UserBundle\Entity\Comite $comite)
    {
        $this->comite = $comite;

        return $this;
    }

    /**
     * Get comite
     *
     * @return \Unipik\UserBundle\Entity\Comite
     */
    public function getComite()
    {
        return $this->comite;
    }

    /**
     * Set benevole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole
     *
     * @return Intervention
     */
    public function setBenevole(\Unipik\UserBundle\Entity\Benevole $benevole = null)
    {
        $this->benevole = $benevole;

        return $this;
    }

    /**
     * Get benevole
     *
     * @return \Unipik\UserBundle\Entity\Benevole
     */
    public function getBenevole()
    {
        return $this->benevole;
    }

    /**
     * Set demande
     *
     * @param \Unipik\InterventionBundle\Entity\Demande $demande
     *
     * @return Intervention
     */
    public function setDemande(\Unipik\InterventionBundle\Entity\Demande $demande)
    {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Get demande
     *
     * @return \Unipik\InterventionBundle\Entity\Demande
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * isPlaidoyer
     *
     * @return boolean
     */
    public function isPlaidoyer()
    {
        $type = $this->getMaterielDispoPlaidoyer();
        return isset($type);
    }

    /**
     * isFrimousse
     *
     * @return boolean
     */
    public function isFrimousse()
    {
        $type = $this->getMateriauxFrimousse();
        return isset($type);
    }

    /**
     * isAutreIntervention
     *
     * @return boolean
     */
    public function isAutreIntervention()
    {
        $type = $this->getDescription();
        return isset($type);
    }

}
