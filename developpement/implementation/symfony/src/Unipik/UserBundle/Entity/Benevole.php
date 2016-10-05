<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;

/**
 * Benevole
 *
 * @ORM\Entity(repositoryClass="Unipik\UserBundle\Entity\BenevoleRepository")
 * @ORM\Table(name="benevole", indexes={@ORM\Index(name="IDX_B4014FDB4DE7DC5C", columns={"adresse_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Benevole extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="benevole_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=true)
     */
    protected $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_fixe", type="string", length=30, nullable=true)
     */
    protected $telFixe;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_portable", type="string", length=30, nullable=true)
     */
    protected $telPortable;


    /**
     * @var string
     *
     * @ORM\Column(name="activites_potentielles", type="string", length=500, nullable=true)
     * @example : '{(frimousses),(plaidoyers),...}'
     */
    protected $activitesPotentielles;

    /**
     * @var string
     *
     * @ORM\Column(name="responsabilite_activite", type="string", length=500, nullable=true)
     * @example : '{(frimousses),(admin_region),...}'
     */
    protected $responsabiliteActivite;


    /**
     * @var \Unipik\ArchitectureBundle\Entity\Adresse
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Adresse", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="adresse_id", referencedColumnName="id" )
     * })
     * @ORM\Column(name="adresse_id", nullable=false)
     */
    protected $adresse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Projet", inversedBy="benevole")
     * @ORM\JoinTable(name="benevole_projet",
     *   joinColumns={
     *     @ORM\JoinColumn(name="benevole_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
     *   }
     * )
     */
    protected $projet;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Comite", inversedBy="benevole")
     * @ORM\JoinTable(name="benevole_comite",
     *   joinColumns={
     *     @ORM\JoinColumn(name="benevole_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="comite_id", referencedColumnName="id")
     *   }
     * )
     */
    protected $comite;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->projet = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comite = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Benevole
     */
    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Benevole
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom() {
        return $this->prenom;
    }

    /**
     * Set telFixe
     *
     * @param string $telFixe
     *
     * @return Benevole
     */
    public function setTelFixe($telFixe) {
        $this->telFixe = $telFixe;
        return $this;
    }

    /**
     * Get telFixe
     *
     * @return string
     */
    public function getTelFixe() {
        return $this->telFixe;
    }

    /**
     * Set telPortable
     *
     * @param string $telPortable
     *
     * @return Benevole
     */
    public function setTelPortable($telPortable) {
        $this->telPortable = $telPortable;
        return $this;
    }

    /**
     * Get telPortable
     *
     * @return string
     */
    public function getTelPortable() {
        return $this->telPortable;
    }

    /**
     * Set activitesPotentielles
     *
     * @param string $activitesPotentielles
     *
     * @return Benevole
     *
     * @deprecated Use addActivitesPetentielles instead
     */
    public function setActivitesPotentielles($activitesPotentielles) {
        $this->activitesPotentielles = $activitesPotentielles;
        return $this;
    }

    /**
     * Add activitesPotentielles
     *
     * @param string|array $activitesPotentielles
     *
     * @return Benevole
     */
    public function addActivitesPotentielles($activitesPotentielles) {
        $this->activitesPotentielles = ArrayConverter::addIntoPgArray(
            $this->activitesPotentielles,
            $activitesPotentielles
        );

        return $this;
    }

    /**
     * Remove activitesPotentielles
     *
     * @param string $activitesPotentielles
     */
    public function removeActivitesPotentielles($activitesPotentielles) {
        $this->activitesPotentielles = ArrayConverter::removeFromPgArray(
            $this->activitesPotentielles,
            $activitesPotentielles
        );
    }

    /**
     * Get activitesPotentielles
     *
     * @return Collection
     */
    public function getActivitesPotentielles() {
        $array = array();
        if ($this->activitesPotentielles != null) {
            $array = ArrayConverter::pgArrayToPhpArray($this->activitesPotentielles);
        }
        return new ArrayCollection($array);
    }

    /**
     * Set responsabiliteActivite
     *
     * @param string $responsabiliteActivite
     *
     * @return Benevole
     *
     * @deprecated
     */
    public function setResponsabiliteActivite($responsabiliteActivite) {
        $this->responsabiliteActivite = $responsabiliteActivite;
        return $this;
    }

    /**
     * Remove responsabiliteActivite
     *
     * @param string $responsabiliteActivite
     */
    public function removeResponsabiliteActive($responsabiliteActivite) {
        $this->responsabiliteActivite = ArrayConverter::removeFromPgArray(
            $this->responsabiliteActivite,
            $responsabiliteActivite
        );
    }

    /**
     * Get responsabiliteActivite
     *
     * @return Collection
     */
    public function getResponsabiliteActivite() {
        $array = array();
        if ($this->responsabiliteActivite != null) {
            $array = ArrayConverter::pgArrayToPhpArray($this->responsabiliteActivite);
        }
        return new ArrayCollection($array);
    }

    /**
     * Add responsabiliteActivite
     *
     * @param string|array $responsabilite
     *
     * @return Benevole
     */
    public function addResponsabiliteActivite($responsabilite) {
        $this->responsabiliteActivite = ArrayConverter::addIntoPgArray(
            $this->responsabiliteActivite,
            $responsabilite
        );

        return $this;
    }

    /**
     * Set adresse
     *
     * @param \Unipik\ArchitectureBundle\Entity\Adresse $adresse
     *
     * @return Benevole
     */
    public function setAdresse(\Unipik\ArchitectureBundle\Entity\Adresse $adresse = null) {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * Get adresse
     *
     * @return \Unipik\ArchitectureBundle\Entity\Adresse
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Add projet
     *
     * @param \Unipik\UserBundle\Entity\Projet $projet
     *
     * @return Benevole
     */
    public function addProjet(\Unipik\UserBundle\Entity\Projet $projet) {
        $this->projet[] = $projet;
        return $this;
    }

    /**
     * Remove projet
     *
     * @param \Unipik\UserBundle\Entity\Projet $projet
     */
    public function removeProjet(\Unipik\UserBundle\Entity\Projet $projet) {
        $this->projet->removeElement($projet);
    }

    /**
     * Get projet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjet() {
        return $this->projet;
    }

    /**
     * Add comite
     *
     * @param \Unipik\UserBundle\Entity\Comite $comite
     *
     * @return Benevole
     */
    public function addComite(\Unipik\UserBundle\Entity\Comite $comite) {
        $this->comite[] = $comite;
        return $this;
    }

    /**
     * Remove comite
     *
     * @param \Unipik\UserBundle\Entity\Comite $comite
     */
    public function removeComite(\Unipik\UserBundle\Entity\Comite $comite) {
        $this->comite->removeElement($comite);
    }

    /**
     * Get comite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComite() {
        return $this->comite;
    }
}
