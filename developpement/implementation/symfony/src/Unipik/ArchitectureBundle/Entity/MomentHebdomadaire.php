<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 *
 * PHP version 5
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MomentHebdomadaire
 *
 * @ORM\Table(name="moment_hebdomadaire")
 * @ORM\Entity
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class MomentHebdomadaire {

    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                                            type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="moment_hebdomadaire_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * Le jour
     *
     * @var string
     *
     * @ORM\Column(name="jour", type="string", length=30, nullable=false)
     */
    private $jour;

    /**
     * Le moment
     *
     * @var string
     *
     * @ORM\Column(name="moment", type="string", length=30, nullable=false)
     */
    private $moment;

    /**
     * Les moments voulus dans la demande
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Demande", inversedBy="momentsVoulus")
     * @ORM\JoinTable(name="demande_moments_voulus",
     *   joinColumns={
     *     @ORM\JoinColumn(name="moments_voulus",                                   referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="demande_en_cours",                                 referencedColumnName="id")
     *   }
     * )
     */
    protected $demandeMomentsVoulus;

    /**
     * Les moments a eviter dans la demande
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Demande", inversedBy="momentsAEviter")
     * @ORM\JoinTable(name="demande_moments_a_eviter",
     *   joinColumns={
     *     @ORM\JoinColumn(name="moments_a_eviter",                                 referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="demande",                                          referencedColumnName="id")
     *   }
     * )
     */
    protected $demandeMomentsAEviter;

    /**
     * Constructor
     */
    public function __construct() {
        $this->demandeMomentsVoulus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->demandeMomentsAEviter = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set jour
     *
     * @param string $jour Le jour
     *
     * @return MomentHebdomadaire
     */
    public function setJour($jour) {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return string
     */
    public function getJour() {
        return $this->jour;
    }

    /**
     * Set moment
     *
     * @param string $moment Le moment
     *
     * @return MomentHebdomadaire
     */
    public function setMoment($moment) {
        $this->moment = $moment;

        return $this;
    }

    /**
     * Get moment
     *
     * @return string
     */
    public function getMoment() {
        return $this->moment;
    }

    /**
     * Add momentsVoulus
     *
     * @param \Unipik\InterventionBundle\Entity\Demande $demande La demande
     *
     * @return MomentHebdomadaire
     */
    public function addDemandeMomentsVoulus(\Unipik\InterventionBundle\Entity\Demande $demande) {
        $this->demandeMomentsVoulus[] = $demande;

        return $this;
    }

    /**
     * Add momentsAEviter
     *
     * @param \Unipik\InterventionBundle\Entity\Demande $demande La demande
     *
     * @return MomentHebdomadaire
     */
    public function addDemandeMomentsAEviter(\Unipik\InterventionBundle\Entity\Demande $demande) {
        $this->demandeMomentsAEviter[] = $demande;

        return $this;
    }

}
