<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
// version 1.01 date 09/09/2016 auteur Julie Pain
namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etablissement
 *
 * @ORM\Table(name="etablissement", indexes={@ORM\Index(name="IDX_20FD592C4DE7DC5C", columns={"adresse_id"})})
 * @ORM\Entity
 */
class Etablissement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="etablissement_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="uai", type="string", length=100, nullable=true)
     */
    private $uai;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_fixe", type="string", length=10, nullable=true)
     */
    private $telFixe;

    /**
     * @var string
     *
     * @ORM\Column(name="emails", type="string", length=10, nullable=false)
     */
    private $emails;

    /**
     * @var string
     *
     * @ORM\Column(name="type_enseignement", type="string", nullable=true)
     */
    private $typeEnseignement;

    /**
     * @var string
     *
     * @ORM\Column(name="type_centre", type="string", nullable=true)
     */
    private $typeCentre;

    /**
     * @var string
     *
     * @ORM\Column(name="type_autre_etablissement", type="string", nullable=true)
     */
    private $typeAutreEtablissement;

    /**
     * @var \Unipik\ArchitectureBundle\Entity\Adresse
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="adresse_id", referencedColumnName="id")
     * })
     */
    private $adresse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Contact", mappedBy="etablissement")
     */
    private $contact;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set uai
     *
     * @param string $uai
     *
     * @return Etablissement
     */
    public function setUai($uai)
    {
        $this->uai = $uai;

        return $this;
    }

    /**
     * Get uai
     *
     * @return string
     */
    public function getUai()
    {
        return $this->uai;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Etablissement
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
     * Set telFixe
     *
     * @param string $telFixe
     *
     * @return Etablissement
     */
    public function setTelFixe($telFixe)
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    /**
     * Get telFixe
     *
     * @return string
     */
    public function getTelFixe()
    {
        return $this->telFixe;
    }

    /**
     * Set emails
     *
     * @param string $emails
     *
     * @return Etablissement
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Get emails
     *
     * @return string
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set typeEnseignement
     *
     * @param string $typeEnseignement
     *
     * @return Etablissement
     */
    public function setTypeEnseignement($typeEnseignement)
    {
        $this->typeEnseignement = $typeEnseignement;

        return $this;
    }

    /**
     * Get typeEnseignement
     *
     * @return string
     */
    public function getTypeEnseignement()
    {
        return $this->typeEnseignement;
    }

    /**
     * Set typeCentre
     *
     * @param string $typeCentre
     *
     * @return Etablissement
     */
    public function setTypeCentre($typeCentre)
    {
        $this->typeCentre = $typeCentre;

        return $this;
    }

    /**
     * Get typeCentre
     *
     * @return string
     */
    public function getTypeCentre()
    {
        return $this->typeCentre;
    }

    /**
     * Set typeAutreEtablissement
     *
     * @param string $typeAutreEtablissement
     *
     * @return Etablissement
     */
    public function setTypeAutreEtablissement($typeAutreEtablissement)
    {
        $this->typeAutreEtablissement = $typeAutreEtablissement;

        return $this;
    }

    /**
     * Get typeAutreEtablissement
     *
     * @return string
     */
    public function getTypeAutreEtablissement()
    {
        return $this->typeAutreEtablissement;
    }

    /**
     * Set adresse
     *
     * @param \Unipik\ArchitectureBundle\Entity\Adresse $adresse
     *
     * @return Etablissement
     */
    public function setAdresse(\Unipik\ArchitectureBundle\Entity\Adresse $adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \Unipik\ArchitectureBundle\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Add contact
     *
     * @param \Unipik\UserBundle\Entity\Contact $contact
     *
     * @return Etablissement
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

    /**
     * isEnseignement
     *
     * @return boolean
     */
    public function isEnseignement()
    {
        $type = $this->getTypeEnseignement();
        return isset($type);
    }

    /**
     * isCentreLoisirs
     *
     * @return boolean
     */
    public function isCentreLoisirs()
    {
        $type = $this->getTypeCentre();
        return isset($type);
    }

    /**
     * isAutreEtablissement
     *
     * @return boolean
     */
    public function isAutreEtablissement()
    {
        $type = $this->getTypeAutreEtablissement();
        return isset($type);
    }
}
