<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 23/05/16
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
use Unipik\InterventionBundle\Form\EtablissementType;

/**
 * L'entity qui gère les etablissements
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class Etablissement
{
    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                                      type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="etablissement_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * L'uai
     *
     * @var string
     *
     * @ORM\Column(name="uai", type="string", length=100, nullable=true)
     */
    private $uai;

    /**
     * Le nom
     *
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=true)
     */
    private $nom;

    /**
     * Le numero de tel fixe
     *
     * @var string
     *
     * @ORM\Column(name="tel_fixe", type="string", length=30, nullable=true)
     */
    private $telFixe;

    /**
     * Les emails
     *
     * @var string
     *
     * @ORM\Column(name="emails", type="string", length=100, nullable=false)
     */
    private $emails;

    /**
     * Le type en cas d'enseignement
     *
     * @var string
     *
     * @ORM\Column(name="type_enseignement", type="string", length=30, nullable=true)
     */
    private $typeEnseignement;

    /**
     * Le type en cas de centre
     *
     * @var string
     *
     * @ORM\Column(name="type_centre", type="string", length=30, nullable=true)
     */
    private $typeCentre;

    /**
     * Le type en cas d'autre etablissement
     *
     * @var string
     *
     * @ORM\Column(name="type_autre_etablissement", type="string", length=30, nullable=true)
     */
    private $typeAutreEtablissement;

    /**
     * L'adresse
     *
     * @var \Unipik\ArchitectureBundle\Entity\Adresse
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Adresse", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="adresse_id",                                      referencedColumnName="id")
     * })
     */
    private $adresse;

    /**
     * Le contact
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Contact", mappedBy="etablissement", cascade={"persist"})
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
     * @param string $uai L'uai
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
     * @param string $nom Le nom
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
     * @param string $telFixe Le tel fixe
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
     * @param string $emails Les emails
     *
     * @return Etablissement
     *
     * @deprecated
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Add email
     *
     * @param string|array $email L'email
     *
     * @return Etablissement
     */
    public function addEmail($email) {
        $this->emails = ArrayConverter::addIntoPgArray(
            $this->emails,
            $email
        );

        return $this;
    }

    /**
     * Remove email
     *
     * @param string $email L'email
     *
     * @return object
     */
    public function removeEmail($email) {
        $this->emails = ArrayConverter::removeFromPgArray(
            $this->emails,
            $email
        );
    }

    /**
     * Get email
     *
     * @return Collection
     */
    public function getEmails() {
        $array = array();
        if ($this->emails != null) {
            $array = ArrayConverter::pgArrayToPhpArray($this->emails);
        }
        return new ArrayCollection($array);
    }

    /**
     * Supprime tous les emails
     *
     * @return Etablissement
     */
    public function removeAllEmails() {
        $this->emails = "{}";
        return $this;
    }

    /**
     * Set typeEnseignement
     *
     * @param string $typeEnseignement Type d'etablissement
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
     * @param string $typeCentre Type de centre
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
     * @param string $typeAutreEtablissement Type d'autre etablissement
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
     * @param \Unipik\ArchitectureBundle\Entity\Adresse $adresse L'adresse
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
     * @param \Unipik\UserBundle\Entity\Contact $contact Le contact
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
    public function getContacts()
    {
        return $this->contact;
    }

    /**
     * Is Enseignement
     *
     * @return boolean
     */
    public function isEnseignement()
    {
        $type = $this->getTypeEnseignement();
        return isset($type);
    }

    /**
     * Is Centre Loisirs
     *
     * @return boolean
     */
    public function isCentreLoisirs()
    {
        $type = $this->getTypeCentre();
        return isset($type);
    }

    /**
     * Is Autre Etablissement
     *
     * @return boolean
     */
    public function isAutreEtablissement()
    {
        $type = $this->getTypeAutreEtablissement();
        return isset($type);
    }
}
