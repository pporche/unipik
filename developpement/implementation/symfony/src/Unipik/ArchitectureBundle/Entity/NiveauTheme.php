<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 *
 * PHP version 5
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NiveauTheme
 *
 * @ORM\Table(name="niveau_theme")
 * @ORM\Entity
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class NiveauTheme {

    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                                     type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="niveau_theme_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * Le niveau
     *
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=30, nullable=true)
     */
    private $niveau;

    /**
     * Le theme
     *
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=100, nullable=true)
     */
    private $theme;

    /**
     * Le comite
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Comite", mappedBy="niveauTheme", cascade={"persist"})
     */
    private $comite;

    /**
     * Constructor
     */
    public function __construct() {
        $this->comite = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set niveau
     *
     * @param string $niveau Le niveau
     *
     * @return NiveauTheme
     */
    public function setNiveau($niveau) {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau() {
        return $this->niveau;
    }

    /**
     * Set theme
     *
     * @param string $theme Le theme
     *
     * @return NiveauTheme
     */
    public function setTheme($theme) {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme() {
        return $this->theme;
    }

    /**
     * Add comite
     *
     * @param \Unipik\UserBundle\Entity\Comite $comite Le comite
     *
     * @return NiveauTheme
     */
    public function addComite(\Unipik\UserBundle\Entity\Comite $comite) {
        $this->comite[] = $comite;

        return $this;
    }

    /**
     * Remove comite
     *
     * @param \Unipik\UserBundle\Entity\Comite $comite Le comite
     *
     * @return object
     */
    public function removeComite(\Unipik\UserBundle\Entity\Comite $comite) {
        $this->comite->removeElement($comite);
    }

    /**
     * Get comite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComites() {
        return $this->comite;
    }
}
