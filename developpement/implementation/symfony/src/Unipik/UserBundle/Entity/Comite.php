<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comite
 *
 * @ORM\Table(name="comite")
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\NiveauTheme", inversedBy="comite", cascade={"persist"})
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
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Benevole", mappedBy="comite", cascade={"persist"})
     */
    private $benevole;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Departement", mappedBy="comite", cascade={"persist"})
     */
    private $departement;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->niveauTheme = new \Doctrine\Common\Collections\ArrayCollection();
        $this->benevole = new \Doctrine\Common\Collections\ArrayCollection();
        $this->departement = new \Doctrine\Common\Collections\ArrayCollection();
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


    /**
     * Add departement
     *
     * @param \Unipik\ArchitectureBundle\Entity\Departement $departement
     *
     * @return Comite
     */
    public function addDepartement(\Unipik\ArchitectureBundle\Entity\Departement $departement)
    {
        $this->departement[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param \Unipik\ArchitectureBundle\Entity\Departement $departement
     */
    public function removeDepartement(\Unipik\ArchitectureBundle\Entity\Departement $departement)
    {
        $this->departement->removeElement($departement);
    }

    /**
     * Get departement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartement()
    {
        return $this->departement;
    }
}
