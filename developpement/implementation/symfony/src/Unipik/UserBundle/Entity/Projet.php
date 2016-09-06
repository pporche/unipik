<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity
 */
class Projet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="projet_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="chiffre_affaire", type="float", precision=10, scale=0, nullable=false)
     */
    private $chiffreAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=1000, nullable=false)
     */
    private $nom;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Benevole", mappedBy="projet")
     */
    private $benevole;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Contact", mappedBy="projet")
     */
    private $contact;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->benevole = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contact = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set chiffreAffaire
     *
     * @param float $chiffreAffaire
     *
     * @return Projet
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
     * Set remarques
     *
     * @param string $remarques
     *
     * @return Projet
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
     * Set type
     *
     * @param string $type
     *
     * @return Projet
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Projet
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Add benevole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole
     *
     * @return Projet
     */
    public function addBenevole(\Unipik\UserBundle\Entity\Benevole $benevole)
    {
        $this->benevole[] = $benevole;

        return $this;
    }

    /**
     * Remove benevole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole
     */
    public function removeBenevole(\Unipik\UserBundle\Entity\Benevole $benevole)
    {
        $this->benevole->removeElement($benevole);
    }

    /**
     * Get benevole
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBenevole()
    {
        return $this->benevole;
    }

    /**
     * Add contact
     *
     * @param \Unipik\UserBundle\Entity\Contact $contact
     *
     * @return Projet
     */
    public function addContact(\Unipik\UserBundle\Entity\Contact $contact)
    {
        $this->contact[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \Unipik\UserBundle\Entity\Contact $contact
     */
    public function removeContact(\Unipik\UserBundle\Entity\Contact $contact)
    {
        $this->contact->removeElement($contact);
    }

    /**
     * Get contact
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContact()
    {
        return $this->contact;
    }
}
