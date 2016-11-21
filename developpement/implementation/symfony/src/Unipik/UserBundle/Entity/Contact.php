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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Unipik\UserBundle\Entity\Participe;

use Symfony\Component\Validator\Constraints as Assert;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class Contact
{
    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                                type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="contact_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * L'email
     *
     * @var string
     *
     * @Assert\Regex(pattern="/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/")
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * Le nom
     *
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * Le prenom
     *
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=true)
     */
    private $prenom;

    /**
     * Le telephone fixe
     *
     * @var string
     *
     * @Assert\Regex(pattern="/(^0[0-9]{9}$)?/")
     *
     * @ORM\Column(name="tel_fixe", type="string", length=30, nullable=true)
     */
    private $telFixe;

    /**
     * Le telephone portable
     *
     * @var string
     *
     * @Assert\Regex(pattern="/(^0[0-9]{9}$)?/")
     *
     * @ORM\Column(name="tel_portable", type="string", length=30,  nullable=true)
     */
    private $telPortable;

    /**
     * Le type de contact
     *
     * @var string
     *
     * @ORM\Column(name="type_contact", type="string", length=30, nullable=false)
     */
    //@Assert\NotBlank()
    private $typeContact;

    /**
     * L'etablissement
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\InterventionBundle\Entity\Etablissement", inversedBy="contact", cascade={"persist"})
     * @ORM\JoinTable(name="appartient",
     *   joinColumns={
     *     @ORM\JoinColumn(name="contact_id",                                             referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="etablissement_id",                                       referencedColumnName="id")
     *   }
     * )
     */
    private $etablissement;

    /**

    /**
     * Est responsable de l'etablissement ou non
     *
     * @var boolean
     *
     * @ORM\Column(name="respo_etablissement", type="boolean", nullable=true)
     */
    private $respoEtablissement;

    /**
     * Type d'activite
     *
     * @var string
     *
     * @ORM\Column(name="type_activite", type="string", length=500, nullable=true)
     */
    private $typeActivite;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany(targetEntity="Participe", mappedBy="contact", nullable=true)
     */
    private $participe;

    /**
     * Constructor
     *
     * @return object
     */
    public function __construct()
    {
        $this->etablissement = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->projet = new \Doctrine\Common\Collections\ArrayCollection();
        $this->participe = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param string $email L'mail
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
     * @param string $nom Le nom
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
     * Get participe
     *
     * @return Participe
     */
    public function getParticipe()
    {
        return $this->participe;
    }

    /**
     * Set prenom
     *
     * @param string $prenom le prenom
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
     * @param string $telFixe Le tel fixe
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
     * @param string $telPortable Le tel portable
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
     * @param string $typeContact Le type de contact
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
     * @param \Unipik\InterventionBundle\Entity\Etablissement $etablissement L'etablissement
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
     * @param \Unipik\InterventionBundle\Entity\Etablissement $etablissement L'etablissement
     *
     * @return object
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
     * @param \Unipik\UserBundle\Entity\Projet $projet Le projet
     *
     * @return Contact
     */
    public function addProjet(\Unipik\UserBundle\Entity\Projet $projet)
    {
        $this->projet[] = $projet;
            //TODO
        return $this;
    }

    /**
     * Remove projet
     *
     * @param \Unipik\UserBundle\Entity\Projet $projet Le projet
     *
     * @return object
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

    //
    //    /**
    //     * Get estTuteur
    //     *
    //     * @todo: déplacer estTuteur dans la colonne participe
    //     *
    //     * @return boolean
    //     */
    //    //    public function isEstTuteur()
    //    //    {
    //    //        return $this->estTuteur;
    //    //    }
    //
    //
    //    /**
    //     * Set estTuteur
    //     *
    //     * @todo: déplacer estTuteur dans la colonne participe
    //     *
    //     * @param bool $estTuteur Tuteur ou non
    //     *
    //     * @return Contact
    //     */
    //    //    public function setEstTuteur($estTuteur)
    //    //    {
    //    //        $this->estTuteur = $estTuteur;
    //    //
    //    //        return $this;
    //    //    }


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
     * @param bool $respoEtablissement Est responsable de l'etablissement
     *
     * @return Contact
     */
    public function setRespoEtablissement($respoEtablissement)
    {
        $this->respoEtablissement = $respoEtablissement;

        return $this;
    }

    /**
     * Set typeActivite
     *
     * @param string $typeActivite Le type d'activite
     *
     * @return Contact
     *
     * @deprecated
     */
    public function setTypeActivite($typeActivite)
    {
        $this->typeActivite = $typeActivite;

        return $this;
    }

    /**
     * Add typeActivite
     *
     * @param string|array $responsabilite La responsabilite
     *
     * @return Contact
     */
    public function addTypeActivite($responsabilite) {
        $this->typeActivite = ArrayConverter::addIntoPgArray(
            $this->typeActivite,
            $responsabilite
        );

        return $this;
    }

    /**
     * Remove typeActivite
     *
     * @param string $typeActivite Le type d'activite
     *
     * @return object
     */
    public function removetypeActivite($typeActivite) {
        $this->typeActivite = ArrayConverter::removeFromPgArray(
            $this->typeActivite,
            $typeActivite
        );
    }

    /**
     * Get typeActivite
     *
     * @return Collection
     */
    public function getTypeActivite() {
        $array = array();
        if ($this->typeActivite != null) {
            $array = ArrayConverter::pgArrayToPhpArray($this->typeActivite);
        }
        return new ArrayCollection($array);
    }



}
