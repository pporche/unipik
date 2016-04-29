<?php
namespace CoreBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use CoreBundle\DBAL\Types\MomentQuotidienType;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
    /**
     * Intervention
     * 
     * @ORM\Entity
     * @ORM\Table(name="intervention")
     * @ORM\InheritanceType("JOINED")
     * @ORM\DiscriminatorColumn(name="type", type="string")
     * @ORM\DiscriminatorMap({"plaidoyer" = "Plaidoyer","frimousse"="Frimousse","autres"="AutreIntervention"}) 
     */
abstract class Intervention {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var date $date
     *
     * @ORM\Column(name="date", type="date", unique=false, nullable=true)
     */
    protected $date;
    
    /**
     * @var string $lieu
     *
     * @ORM\Column(name="lieu", type="string", length=40, nullable=true)
     */
    protected $lieu;
    
    /**
     * @var int $nbPersonne
     *
     * @ORM\Column(name="nb_personne", type="integer", nullable=false)
     */
    protected $nbPersonne;
    
    /**
     * @var string $remarques
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    protected $remarques;
    
    /**
     *
     * @ORM\Column(name="moment", type="MomentQuotidienType", nullable=true)
     * @DoctrineAssert\Enum(entity="CoreBundle\DBAL\Types\MomentQuotidienType")     
     */
    protected $moment;
    
    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Demande")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $demande;
    
    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Benevole")
     * @ORM\JoinColumn(nullable=false)
     */
     protected $benevole;
    
    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Comite")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $comite;
    
     /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Etablissement")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $etablissement;
    
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu() {
        return $this->lieu;
    }

    /**
     * Get nbPersonne
     *
     * @return \int
     */
    public function getNbPersonne() {
        return $this->nbPersonne;
    }

    /**
     * Get remarques
     *
     * @return string
     */
    public function getRemarques() {
        return $this->remarques;
    }

    /**
     * Get moment
     *
     * @return MomentQuotidienType
     */
    public function getMoment() {
        return $this->moment;
    }
    
      /**
     * Get demande
     *
     * @return \CoreBundle\Entity\Demande
     */
    public function getDemande() {
        return $this->demande;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Intervention
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
     * @return Intervention
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
     * @return Intervention
     */
    public function setNbPersonne($nbPersonne) {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    /**
     * Get benevole
     *
     * @return \CoreBundle\Entity\Benevole
     */
    public function getBenevole() {
        return $this->benevole;
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
     * Get etablissement
     *
     * @return \CoreBundle\Entity\Etablissement
     */
    public function getEtablissement() {
        return $this->etablissement;
    }
}
