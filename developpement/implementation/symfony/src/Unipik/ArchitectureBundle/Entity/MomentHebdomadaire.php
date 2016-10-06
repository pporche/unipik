<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MomentHebdomadaire
 *
 * @ORM\Table(name="moment_hebdomadaire")
 * @ORM\Entity
 */
class MomentHebdomadaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="moment_hebdomadaire_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="jour", type="string", length=30, nullable=false)
     */
    private $jour;

    /**
     * @var string
     *
     * @ORM\Column(name="moment", type="string", length=30, nullable=false)
     */
    private $moment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Demande", inversedBy="momentsVoulus")
     * @ORM\JoinTable(name="demande_moments_voulus",
     *   joinColumns={
     *     @ORM\JoinColumn(name="moments_voulus", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="demande_en_cours", referencedColumnName="id")
     *   }
     * )
     */
    protected $demandeMomentsVoulus;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Demande", inversedBy="momentsAEviter")
     * @ORM\JoinTable(name="demande_moments_a_eviter",
     *   joinColumns={
     *     @ORM\JoinColumn(name="moments_a_eviter", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="demande", referencedColumnName="id")
     *   }
     * )
     */
    protected $demandeMomentsAEviter;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->demandeMomentsVoulus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->demandeMomentsAEviter = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set jour
     *
     * @param string $jour
     *
     * @return MomentHebdomadaire
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return string
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set moment
     *
     * @param string $moment
     *
     * @return MomentHebdomadaire
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

//    /**
//     * Add demandeMomentsVoulus
//     *
//     * @param \Unipik\InterventionBundle\Entity\Demande $demande
//     *
//     * @return MomentHebdomadaire
//     */
//    public function addDemandeMomentsVoulus(\Unipik\InterventionBundle\Entity\Demande $demande)
//    {
//        $this->demandeMomentsVoulus[] = $demande;
//
//        return $this;
//    }
//
//    /**
//     * Remove demandeMomentsVoulus
//     *
//     * @param \Unipik\InterventionBundle\Entity\Demande $demande
//     */
//    public function removeDemandeMomentsVoulus(\Unipik\InterventionBundle\Entity\Demande $demande)
//    {
//        $this->demandeMomentsVoulus->removeElement($demande);
//    }
//
//    /**
//     * Get demandeMomentsVoulus
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getDemandeMomentsVoulus()
//    {
//        return $this->demandeMomentsVoulus;
//    }
//
//    /**
//     * Add demandeMomentsAEviter
//     *
//     * @param \Unipik\InterventionBundle\Entity\Demande $demande
//     *
//     * @return MomentHebdomadaire
//     */
//    public function addDemandeMomentsAEviter(\Unipik\InterventionBundle\Entity\Demande $demande)
//    {
//        $this->demandeMomentsAEviter[] = $demande;
//
//        return $this;
//    }
//
//    /**
//     * Remove demandeMomentsAEviter
//     *
//     * @param \Unipik\InterventionBundle\Entity\Demande $demande
//     */
//    public function removeDemandeMomentsAEviter(\Unipik\InterventionBundle\Entity\Demande $demande)
//    {
//        $this->demandeMomentsAEviter->removeElement($demande);
//    }
//
//    /**
//     * Get demandeMomentsAEviter
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getDemandeMomentsAEviter()
//    {
//        return $this->demandeMomentsAEviter;
//    }
}
