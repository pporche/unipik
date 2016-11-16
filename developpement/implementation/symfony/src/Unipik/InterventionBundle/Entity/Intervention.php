<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 13/05/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
namespace Unipik\InterventionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;

/**
 * L'entity qui gère les interventions
 *
 * @ORM\Entity(repositoryClass="Unipik\InterventionBundle\Entity\InterventionRepository")
 * @ORM\Table(name="intervention",                                                        indexes={@ORM\Index(name="IDX_D11814ABE004B434", columns={"niveau_theme_id"}), @ORM\Index(name="IDX_D11814ABFF631228", columns={"etablissement_id"}), @ORM\Index(name="IDX_D11814ABD61C3573", columns={"comite_id"}), @ORM\Index(name="IDX_D11814ABE77B7C09", columns={"benevole_id"}), @ORM\Index(name="IDX_D11814AB80E95E18", columns={"demande_id"})})
 * @ORM\Entity
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class Intervention
{
    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                                     type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="intervention_id_seq", allocationSize=1, initialValue=1)
     */
    public $id;

    /**
     * La date d'intervention
     *
     * @var \DateTime
     *
     * @ORM\Column(name="date_intervention", type="date", nullable=true)
     */
    public $dateIntervention;

    /**
     * Le lieu
     *
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=100, nullable=true)
     */
    public $lieu;

    /**
     * Le nombre de personnes
     *
     * @var integer
     *
     * @ORM\Column(name="nb_personne", type="integer", nullable=false)
     */
    public $nbPersonne;

    /**
     * Les remarques
     *
     * @var string
     *
     * @ORM\Column(name="remarques", type="string", length=500 nullable=true)
     */
    public $remarques;

    /**
     * L'heure
     *
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=30, nullable=true)
     */
    public $heure;

    /**
     * Realisee ou non
     *
     * @var boolean
     *
     * @ORM\Column(name="realisee", type="boolean", nullable=false)
     */
    public $realisee;


    /**
     * Le materiel disponible en cas de plaidoyer
     *
     * @var string
     *
     * @ORM\Column(name="materiel_dispo_plaidoyer", type="string", length=500, nullable=true)
     * @example                                     : '{(enceinte},(autre)'
     */
    public $materielDispoPlaidoyer;

    /**
     * Le niveau en cas de frimousse
     *
     * @var string
     *
     * @ORM\Column(name="niveau_frimousse", type="string", length=30, nullable=true)
     */
    public $niveauFrimousse;

    /**
     * Le materiel disponible en cas de plaidoyer
     *
     * @var string
     *
     * @ORM\Column(name="materiaux_frimousse", type="string", length=500, nullable=true)
     */
    public $materiauxFrimousse;

    /**
     * La description
     *
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    public $description;

    /**
     * Les themes en fonction du niveau
     *
     * @var \Unipik\ArchitectureBundle\Entity\NiveauTheme
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\NiveauTheme", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau_theme_id",                                     referencedColumnName="id")
     * })
     */
    public $niveauTheme;

    /**
     * L'etablissement
     *
     * @var \Unipik\InterventionBundle\Entity\Etablissement
     *
     * @ORM\ManyToOne(targetEntity="Unipik\InterventionBundle\Entity\Etablissement", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etablissement_id",                                      referencedColumnName="id")
     * })
     */
    public $etablissement;

    /**
     * Le comite
     *
     * @var \Unipik\UserBundle\Entity\Comite
     *
     * @ORM\ManyToOne(targetEntity="Unipik\UserBundle\Entity\Comite", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comite_id",                              referencedColumnName="id")
     * })
     */
    public $comite;

    /**
     * Le benevole
     *
     * @var \Unipik\UserBundle\Entity\Benevole
     *
     * @ORM\ManyToOne(targetEntity="Unipik\UserBundle\Entity\Benevole", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="benevole_id",                              referencedColumnName="id")
     * })
     */
    public $benevole;

    /**
     * La demande associee
     *
     * @var \Unipik\InterventionBundle\Entity\Demande
     *
     * @ORM\ManyToOne(targetEntity="Unipik\InterventionBundle\Entity\Demande", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="demande_id",                                      referencedColumnName="id")
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
     * @param \DateTime $date La date
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
     * @param string $lieu Le lieu
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
     * @param integer $nbPersonne Le nombre de personnes
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
     * @param string $remarques Les remarques
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
     * @param string $heure L'heure
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
     * @param boolean $realisee Realisee ou non
     *
     * @return Intervention
     */
    public function setRealisee($realisee)
    {
        $this->realisee = $realisee;

        return $this;
    }


    /**
     * Is Realisee
     *
     * @return boolean
     */
    public function isRealisee()
    {
        return $this->realisee;
    }


    /**
     * Set materielDispoPlaidoyer
     *
     * @param string $materielDispoPlaidoyer Le materiel
     *
     * @return Intervention
     *
     * @deprecated
     */
    public function setMaterielDispoPlaidoyer($materielDispoPlaidoyer)
    {
        $this->materielDispoPlaidoyer = $materielDispoPlaidoyer;

        return $this;
    }

    /**
     * Add materielDispoPlaidoyer
     *
     * @param string|array $materielDispoPlaidoyer Le materiel
     *
     * @return Intervention
     */
    public function addMaterielDispoPlaidoyer($materielDispoPlaidoyer) {
        $this->materielDispoPlaidoyer = ArrayConverter::addIntoPgArray(
            $this->materielDispoPlaidoyer,
            $materielDispoPlaidoyer
        );

        return $this;
    }

    /**
     * Remove materielDispoPlaidoyer
     *
     * @param string $materielDispoPlaidoyer Le materiel
     *
     * @return object
     */
    public function removeMaterielDispoPlaidoyer($materielDispoPlaidoyer) {
        $this->materielDispoPlaidoyer = ArrayConverter::removeFromPgArray(
            $this->materielDispoPlaidoyer,
            $materielDispoPlaidoyer
        );
    }

    /**
     * Get materielDispoPlaidoyer
     *
     * @return Collection
     */
    public function getMaterielDispoPlaidoyer() {
        $array = array();
        if ($this->materielDispoPlaidoyer != null) {
            $array = ArrayConverter::pgArrayToPhpArray($this->materielDispoPlaidoyer);
        }
        return new ArrayCollection($array);
    }

    /**
     * Retire le materiel
     *
     * @return $this
     */
    public function removeAllMaterielDispoPlaidoyer() {
        $this->materielDispoPlaidoyer = "";
        return $this;
    }

    /**
     * Set niveauFrimousse
     *
     * @param string $niveauFrimousse Le niveau en cas de frimousse
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
     * @param string $materiauxFrimousse Les materiaux
     *
     * @return Intervention
     *
     * @deprecated
     */
    public function setMateriauxFrimousse($materiauxFrimousse)
    {
        $this->materiauxFrimousse = $materiauxFrimousse;

        return $this;
    }

    /**
     * Add materiauxFrimousse
     *
     * @param string|array $materiau Matreriaux
     *
     * @return Intervention
     */
    public function addMateriauxFrimousse($materiau) {
        $this->materiauxFrimousse = ArrayConverter::addIntoPgArray(
            $this->materiauxFrimousse,
            $materiau
        );

        return $this;
    }

    /**
     * Remove materiauxFrimousse
     *
     * @param string $materiauxFrimousse Materiaux
     *
     * @return object
     */
    public function removeMateriauxFrimousse($materiauxFrimousse) {
        $this->materiauxFrimousse = ArrayConverter::removeFromPgArray(
            $this->materiauxFrimousse,
            $materiauxFrimousse
        );
    }

    /**
     * Get materiauxFrimousse
     *
     * @return Collection
     */
    public function getMateriauxFrimousse() {
        $array = array();
        if ($this->materiauxFrimousse != null) {
            $array = ArrayConverter::pgArrayToPhpArray($this->materiauxFrimousse);
        }
        return new ArrayCollection($array);
    }

    /**
     * Retire les materiaux
     *
     * @return $this
     */
    public function removeAllMateriauxFrimousse() {
        $this->materiauxFrimousse = "";
        return $this;
    }

    /**
     * Set description
     *
     * @param string $description La description
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
     * @param \Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme Le theme en fonction du niveau
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
     * @param \Unipik\InterventionBundle\Entity\Etablissement $etablissement L'etablissement
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
     * @param \Unipik\UserBundle\Entity\Comite $comite Le comite
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
     * @param \Unipik\UserBundle\Entity\Benevole $benevole Le benevole
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
     * @param \Unipik\InterventionBundle\Entity\Demande $demande La demande
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
     * Is Plaidoyer
     *
     * @return boolean
     */
    public function isPlaidoyer()
    {
        $type = $this->getMaterielDispoPlaidoyer();
        return !($type->isEmpty());
    }

    /**
     * Is Frimousse
     *
     * @return boolean
     */
    public function isFrimousse()
    {
        $type = $this->getMateriauxFrimousse();
        return !($type->isEmpty());
    }

    /**
     * Is Autre Intervention
     *
     * @return boolean
     */
    public function isAutreIntervention()
    {
        $type = $this->getDescription();
        return !($type == "");
    }

}
