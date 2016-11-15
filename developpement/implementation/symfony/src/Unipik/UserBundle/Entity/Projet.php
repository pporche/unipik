<?php
/**
 * Created by PhpStorm.
 * User: Kafui
 * Date: 13/09/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class Projet {

    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                               type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="projet_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * Le CA
     *
     * @var float
     *
     * @ORM\Column(name="chiffre_affaire", type="float", precision=10, scale=0, nullable=false)
     */
    private $chiffreAffaire;

    /**
     * Les remarques
     *
     * @var string
     *
     * @ORM\Column(name="remarques", type="string",length=500, nullable=true)
     */
    private $remarques;

    /**
     * Le type
     *
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;

    /**
     * Le nom
     *
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * Le benevole
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Benevole", mappedBy="projet", cascade={"persist"})
     */
    private $benevole;

    /**
     * Le contact
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Contact", mappedBy="projet", cascade={"persist"})
     */
    private $contact;

    /**
     * Constructor
     *
     * @return object
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
     * @param float $chiffreAffaire Le CA
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
     * @param string $remarques Les remarques
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
     * @param string $type Le type
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
     * @param string $nom Le nom
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
     * @param \Unipik\UserBundle\Entity\Benevole $benevole Le benevole
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
     * @param \Unipik\UserBundle\Entity\Benevole $benevole Le benevole
     *
     * @return object
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
     * @param \Unipik\UserBundle\Entity\Contact $contact Le contact
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
     * @param \Unipik\UserBundle\Entity\Contact $contact Le contact
     *
     * @return object
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
