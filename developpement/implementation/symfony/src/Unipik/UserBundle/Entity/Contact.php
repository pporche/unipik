<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="contact_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_fixe", type="string", length=10, nullable=true)
     */
    private $telFixe;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_portable", type="string", length=10,  nullable=true)
     */
    private $telPortable;

    /**
     * @var string
     *
     * @ORM\Column(name="type_contact", type="string", length=20, nullable=false)
     */
    private $typeContact;

    

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\InterventionBundle\Entity\Etablissement", inversedBy="contact")
     * @ORM\JoinTable(name="appartient",
     *   joinColumns={
     *     @ORM\JoinColumn(name="etablissement_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     *   }
     * )
     */
    private $etablissement;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Projet", inversedBy="contact")
     * @ORM\JoinTable(name="participe",
     *   joinColumns={
     *     @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     *   }
     * )
     */
    private $projet;


    /**
     * @var boolean
     *
     * @ORM\Column(name="est_tuteur", type="boolean", nullable=true)
     */
    private $estTuteur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="respo_etablissement", type="boolean", nullable=true)
     */
    private $respoEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="type_activite", type="string", length=100, nullable=true)
     */
    private $typeActivite;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etablissement = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projet = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Contact
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Contact
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telFixe
     *
     * @param string $telFixe
     *
     * @return Contact
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
     * Set telPortable
     *
     * @param string $telPortable
     *
     * @return Contact
     */
    public function setTelPortable($telPortable)
    {
        $this->telPortable = $telPortable;

        return $this;
    }

    /**
     * Get telPortable
     *
     * @return string
     */
    public function getTelPortable()
    {
        return $this->telPortable;
    }

    /**
     * Set typeContact
     *
     * @param string $typeContact
     *
     * @return Contact
     */
    public function setTypeContact($typeContact)
    {
        $this->typeContact = $typeContact;

        return $this;
    }

    /**
     * Get typeContact
     *
     * @return string
     */
    public function getTypeContact()
    {
        return $this->typeContact;
    }

    /**
     * Add etablissement
     *
     * @param \Unipik\InterventionBundle\Entity\Etablissement $etablissement
     *
     * @return Contact
     */
    public function addEtablissement(\Unipik\InterventionBundle\Entity\Etablissement $etablissement)
    {
        $this->etablissement[] = $etablissement;

        return $this;
    }

    /**
     * Remove etablissement
     *
     * @param \Unipik\InterventionBundle\Entity\Etablissement $etablissement
     */
    public function removeEtablissement(\Unipik\InterventionBundle\Entity\Etablissement $etablissement)
    {
        $this->etablissement->removeElement($etablissement);
    }

    /**
     * Get etablissement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Add projet
     *
     * @param \Unipik\UserBundle\Entity\Projet $projet
     *
     * @return Contact
     */
    public function addProjet(\Unipik\UserBundle\Entity\Projet $projet)
    {
        $this->projet[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param \Unipik\UserBundle\Entity\Projet $projet
     */
    public function removeProjet(\Unipik\UserBundle\Entity\Projet $projet)
    {
        $this->projet->removeElement($projet);
    }

    /**
     * Get projet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjet()
    {
        return $this->projet;
    }


    /**
     * Get estTuteur
     *
     * @return boolean
     */
    public function isEstTuteur()
    {
        return $this->estTuteur;
    }


    /**
     * Set estTuteur
     *
     * @param boolean $estTuteur
     *
     * @return Contact
     */
    public function setEstTuteur($estTuteur)
    {
        $this->estTuteur = $estTuteur;
    }


    /**
     * Get respoEtablissement
     *
     * @return boolean
     */
    public function isRespoEtablissement()
    {
        return $this->respoEtablissement;
    }

    /**
     * Set respoEtablissement
     *
     * @param boolean $respoEtablissement
     *
     * @return Contact
     */
    public function setRespoEtablissement($respoEtablissement)
    {
        $this->respoEtablissement = $respoEtablissement;
    }


    /**
     * Get typeActivite
     *
     * @return string
     */
    public function getTypeActivite()
    {
        return $this->typeActivite;
    }

    /**
     * Set typeActivite
     *
     * @param string $typeActivite
     *
     * @return Contact
     */
    public function setTypeActivite($typeActivite)
    {
        $this->typeActivite = $typeActivite;
    }
}
