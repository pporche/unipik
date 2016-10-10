<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\InterventionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="IDX_2694D7A5E7A1254A", columns={"contact_id"})})
 * @ORM\Entity
 */
class Demande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="demande_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="date", nullable=false)
     */
    private $dateDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="liste_semaine", type="string", length=500, nullable=false)
     */
    private $listeSemaine;

    /**
     * @var \Unipik\UserBundle\Entity\Contact
     *
     * @ORM\ManyToOne(targetEntity="Unipik\UserBundle\Entity\Contact", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     * })
     */
    private $contact;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\MomentHebdomadaire", mappedBy="demandeMomentsVoulus", cascade={"persist"})
     */
    private $momentsVoulus;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\MomentHebdomadaire", mappedBy="demandeMomentsAEviter", cascade={"persist"})
     */
    private $momentsAEviter;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->momentsVoulus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->momentsAEviter = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set date de demande
     *
     * @param \DateTime $date
     *
     * @return Demande
     */
    public function setDateDemande($date)
    {
        $this->dateDemande = $date;

        return $this;
    }

    /**
     * Get date de demande
     *
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * Set listeSemaine
     *
     * @deprecated
     *
     * @param string $listeSemaine
     *
     * @return Demande
     */
    public function setListeSemaine($listeSemaine)
    {
        $this->listeSemaine = $listeSemaine;

        return $this;
    }

    /**
     * Get listeSemaine
     *
     * @deprecated
     *
     * @return string
     */
    public function getListeSemaine()
    {
        return $this->listeSemaine;
    }

    /**
     * Add semaine
     *
     * @param string|array $semaine
     *
     * @return Demande
     */
    public function addSemaine($semaine) {
        $this->listeSemaine = ArrayConverter::addIntoPgArray(
            $this->listeSemaine,
            $semaine
        );

        return $this;
    }

    /**
     * Remove semaine
     *
     * @param string $semaine
     */
    public function removeSemaine($semaine) {
        $this->listeSemaine = ArrayConverter::removeFromPgArray(
            $this->listeSemaine,
            $semaine
        );
    }

    /**
     * Get semaine
     *
     * @return Collection
     */
    public function getSemaines() {
        $array = array();
        if ($this->listeSemaine != null) {
            $array = ArrayConverter::pgArrayToPhpArray($this->listeSemaine);
        }
        return new ArrayCollection($array);
    }

    /**
     * Set contact
     *
     * @param \Unipik\UserBundle\Entity\Contact $contact
     *
     * @return Demande
     */
    public function setContact(\Unipik\UserBundle\Entity\Contact $contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \Unipik\UserBundle\Entity\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Add momentsVoulus
     *
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsVoulus
     *
     * @return Demande
     */
    public function addMomentsVoulus(\Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsVoulus)
    {
        $this->momentsVoulus[] = $momentsVoulus;

        return $this;
    }

    /**
     * Remove momentsVoulus
     *
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsVoulus
     */
    public function removeMomentsVoulus(\Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsVoulus)
    {
        $this->momentsVoulus->removeElement($momentsVoulus);
    }

    /**
     * Get momentsVoulus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMomentsVoulus()
    {
        return $this->momentsVoulus;
    }

    /**
     * Add momentsAEviter
     *
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsAEviter
     *
     * @return Demande
     */
    public function addMomentsAEviter(\Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsAEviter)
    {
        $this->momentsAEviter[] = $momentsAEviter;

        return $this;
    }

    /**
     * Remove momentsAEviter
     *
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsAEviter
     */
    public function removeMomentsAEviter(\Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsAEviter)
    {
        $this->momentsAEviter->removeElement($momentsAEviter);
    }

    /**
     * Get momentsAEviter
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMomentsAEviter()
    {
        return $this->momentsAEviter;
    }
}
