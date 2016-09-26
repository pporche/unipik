<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comite
 *
 * @ORM\Table(name="comite", indexes={@ORM\Index(name="IDX_DC01CA9F98260155", columns={"region_id"})})
 * @ORM\Entity
 */
class Comite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="comite_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_departement", type="string", length=40, nullable=false)
     */
    private $nomDepartement;

    /**
     * @var \Unipik\UserBundle\Entity\Region
     *
     * @ORM\ManyToOne(targetEntity="Unipik\UserBundle\Entity\Region", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     * })
     */
    private $region;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\NiveauTheme", inversedBy="comite")
     * @ORM\JoinTable(name="comite_niveau_theme",
     *   joinColumns={
     *     @ORM\JoinColumn(name="comite", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="niveau_theme", referencedColumnName="id")
     *   }
     * )
     */
    private $niveauTheme;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Benevole", mappedBy="comite")
     */
    private $benevole;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->niveauTheme = new \Doctrine\Common\Collections\ArrayCollection();
        $this->benevole = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nomDepartement
     *
     * @param string $nomDepartement
     *
     * @return Comite
     */
    public function setNomDepartement($nomDepartement)
    {
        $this->nomDepartement = $nomDepartement;

        return $this;
    }

    /**
     * Get nomDepartement
     *
     * @return string
     */
    public function getNomDepartement()
    {
        return $this->nomDepartement;
    }

    /**
     * Set region
     *
     * @param \Unipik\UserBundle\Entity\Region $region
     *
     * @return Comite
     */
    public function setRegion(\Unipik\UserBundle\Entity\Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Unipik\UserBundle\Entity\Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Add niveauTheme
     *
     * @param \Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme
     *
     * @return Comite
     */
    public function addNiveauTheme(\Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme)
    {
        $this->niveauTheme[] = $niveauTheme;

        return $this;
    }

    /**
     * Remove niveauTheme
     *
     * @param \Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme
     */
    public function removeNiveauTheme(\Unipik\ArchitectureBundle\Entity\NiveauTheme $niveauTheme)
    {
        $this->niveauTheme->removeElement($niveauTheme);
    }

    /**
     * Get niveauTheme
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNiveauTheme()
    {
        return $this->niveauTheme;
    }

    /**
     * Add benevole
     *
     * @param \Unipik\UserBundle\Entity\Benevole $benevole
     *
     * @return Comite
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
}
