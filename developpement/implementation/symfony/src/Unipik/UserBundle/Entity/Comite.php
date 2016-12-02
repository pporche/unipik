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
 * Comite
 *
 * @ORM\Table(name="comite")
 * @ORM\Entity
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class Comite {

    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                               type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="comite_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * Le nom
     *
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;


    /**
     * Le niveau en fonction du theme
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\NiveauTheme", inversedBy="comite", cascade={"persist"})
     * @ORM\JoinTable(name="comite_niveau_theme",
     *   joinColumns={
     *     @ORM\JoinColumn(name="comite",                                               referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="niveau_theme",                                         referencedColumnName="id")
     *   }
     * )
     */
    private $niveauTheme;

    /**
     * Le benevole
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Benevole", mappedBy="comite", cascade={"persist"})
     */
    private $benevole;

    /**
     * Le departement
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Departement", mappedBy="comite", cascade={"persist"})
     */
    private $departement;


    /**
     * Constructor
     *
     * @return object
     */
    public function __construct() {
        $this->niveauTheme = new \Doctrine\Common\Collections\ArrayCollection();
        $this->benevole = new \Doctrine\Common\Collections\ArrayCollection();
        $this->departement = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add niveauTheme
     *
     * @param \Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme Le niveautheme
     *
     * @return Comite
     */
    public function addNiveauTheme(\Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme) {
        $this->niveauTheme[] = $niveauTheme;

        return $this;
    }

    /**
     * Remove niveauTheme
     *
     * @param \Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme Le niveautheme
     *
     * @return object
     */
    public function removeNiveauTheme(\Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme) {
        $this->niveauTheme->removeElement($niveauTheme);
    }

    /**
     * Get niveauTheme
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNiveauTheme() {
        return $this->niveauTheme;
    }

    /**
     * Add benevole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole Le benevole
     *
     * @return Comite
     */
    public function addBenevole(\Unipik\UserBundle\Entity\Benevole $benevole) {
        $this->benevole[] = $benevole;

        return $this;
    }

    /**
     * Remove benevole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole le benevole
     *
     * @return object
     */
    public function removeBenevole(\Unipik\UserBundle\Entity\Benevole $benevole) {
        $this->benevole->removeElement($benevole);
    }

    /**
     * Get benevole
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBenevole() {
        return $this->benevole;
    }


    /**
     * Add departement
     *
     * @param \Unipik\ArchitectureBundle\Entity\Departement $departement Le departement
     *
     * @return Comite
     */
    public function addDepartement(\Unipik\ArchitectureBundle\Entity\Departement $departement) {
        $this->departement[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param \Unipik\ArchitectureBundle\Entity\Departement $departement Le departement
     *
     * @return object
     */
    public function removeDepartement(\Unipik\ArchitectureBundle\Entity\Departement $departement) {
        $this->departement->removeElement($departement);
    }

    /**
     * Get departement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartement() {
        return $this->departement;
    }

    /**
     * Set nom
     *
     * @param string $nom Le nom
     *
     * @return Departement
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }
}
