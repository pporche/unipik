<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervention
 *
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
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=40, nullable=true)
     */
    private $lieu;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_personne", type="integer", nullable=false)
     */
    private $nbPersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var string
     *
     * @ORM\Column(name="moment", type="string", length=15, nullable=true)
     */
    private $moment;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="materiel_dispo_plaidoyer", type="string", length=80, nullable=true)
     * @example : '{(enceinte},(autre)'
     */
    private $materielDispoPlaidoyer;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_frimousse", type="string", length(15), nullable=true)
     */
    private $niveauFrimousse;

    /**
     * @var string
     *
     * @ORM\Column(name="materiaux_frimousse", type="string", length=60, nullable=true)
     */
    private $materiauxFrimousse;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=true)
     */
    private $description;

    /**
     * @var \Unipik\ArchitectureBundle\Entity\NiveauTheme
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\NiveauTheme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau_theme_id", referencedColumnName="id")
     * })
     */
    private $niveauTheme;

    /**
     * @var \Unipik\InterventionBundle\Entity\Etablissement
     *
     * @ORM\ManyToOne(targetEntity="Unipik\InterventionBundle\Entity\Etablissement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etablissement_id", referencedColumnName="id")
     * })
     */
    private $etablissement;

    /**
     * @var \Unipik\InterventionBundle\Entity\Comite
     *
     * @ORM\ManyToOne(targetEntity="Unipik\InterventionBundle\Entity\Comite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comite_id", referencedColumnName="id")
     * })
     */
    private $comite;

    /**
     * @var \Unipik\UserBundle\Entity\Benevole
     *
     * @ORM\ManyToOne(targetEntity="Unipik\UserBundle\Entity\Benevole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="benevole_id", referencedColumnName="id")
     * })
     */
    private $benevole;

    /**
     * @var \Unipik\InterventionBundle\Entity\Demande
     *
     * @ORM\ManyToOne(targetEntity="Unipik\InterventionBundle\Entity\Demande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="demande_id", referencedColumnName="id")
     * })
     */
    private $demande;



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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Intervention
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
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
     * Set moment
     *
     * @param string $moment
     *
     * @return Intervention
     */
    public function setMoment($moment)
    {
        $this->moment = $moment;

        return $this;
    }

    /**
     * Get moment
     *
     * @return string
     */
    public function getMoment()
    {
        return $this->moment;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Intervention
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * @param \Unipik\InterventionBundle\Entity\Comite $comite
     *
     * @return Intervention
     */
    public function setComite(\Unipik\InterventionBundle\Entity\Comite $comite)
    {
        $this->comite = $comite;

        return $this;
    }

    /**
     * Get comite
     *
     * @return \Unipik\InterventionBundle\Entity\Comite
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
     * @param \Unipik\ArchitectureBundle\Entity\Demande $demande
     *
     * @return Intervention
     */
    public function setDemande(\Unipik\ArchitectureBundle\Entity\Demande $demande)
    {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Get demande
     *
     * @return \Unipik\ArchitectureBundle\Entity\Demande
     */
    public function getDemande()
    {
        return $this->demande;
    }
}
