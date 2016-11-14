<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 19/04/16
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
 * Demande
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="IDX_2694D7A5E7A1254A", columns={"contact_id"})})
 * @ORM\Entity
 */
class Demande
{
    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                                type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="demande_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * La date de demande
     *
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="date", nullable=false)
     */
    private $dateDemande;

    /**
     * La liste de semaines
     *
     * @var string
     *
     * @ORM\Column(name="liste_semaine", type="string", length=500, nullable=false)
     */
    private $listeSemaine;

    /**
     * Le contact
     *
     * @var \Unipik\UserBundle\Entity\Contact
     *
     * @ORM\ManyToOne(targetEntity="Unipik\UserBundle\Entity\Contact", cascade={"persist"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="contact_id",                              referencedColumnName="id")
     * })
     */
    private $contact;


    /**
     * Les moments voulus
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\MomentHebdomadaire", mappedBy="demandeMomentsVoulus", cascade={"persist"})
     */
    private $momentsVoulus;

    /**
     * Les moments a éviter
     *
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
     * @param \DateTime $date La date
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
     * @param string $listeSemaine La liste de semaines
     *
     * @return Demande
     *
     * @deprecated
     */
    public function setListeSemaine($listeSemaine)
    {
        $this->listeSemaine = $listeSemaine;

        return $this;
    }

    /**
     * Get listeSemaine
     *
     * @return string
     *
     * @deprecated
     */
    public function getListeSemaine()
    {
        return $this->listeSemaine;
    }

    /**
     * Add semaine
     *
     * @param string|array $semaine La semaine
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
     * @param string $semaine La semaine
     *
     * @return object
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
     * @param \Unipik\UserBundle\Entity\Contact $contact Le contact
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
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsVoulus Les moments voulus
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
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsVoulus Les moments voulus
     *
     * @return object
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
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsAEviter Les moments a eviter
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
     * @param \Unipik\ArchitectureBundle\Entity\MomentHebdomadaire $momentsAEviter Les moments a eviter
     *
     * @return object
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
