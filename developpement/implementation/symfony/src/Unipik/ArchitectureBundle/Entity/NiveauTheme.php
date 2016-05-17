<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NiveauTheme
 *
 * @ORM\Table(name="niveau_theme")
 * @ORM\Entity
 */
class NiveauTheme
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="niveau_theme_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", nullable=true)
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", nullable=true)
     */
    private $theme;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Comite", mappedBy="niveauTheme")
     */
    private $comite;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comite = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set niveau
     *
     * @param string $niveau
     *
     * @return NiveauTheme
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return NiveauTheme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Add comite
     *
     * @param \Unipik\UserBundle\Entity\Comite $comite
     *
     * @return NiveauTheme
     */
    public function addComite(\Unipik\UserBundle\Entity\Comite $comite)
    {
        $this->comite[] = $comite;

        return $this;
    }

    /**
     * Remove comite
     *
     * @param \Unipik\UserBundle\Entity\Comite $comite
     */
    public function removeComite(\Unipik\UserBundle\Entity\Comite $comite)
    {
        $this->comite->removeElement($comite);
    }

    /**
     * Get comite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComite()
    {
        return $this->comite;
    }
}
