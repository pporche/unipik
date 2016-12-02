<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 26/09/16
 * Time: 10:26
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
 * Ville
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity
 */
class Ville {

    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                              type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ville_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * Le nom
     *
     * @var                    string
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * Le code postal
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\CodePostal", mappedBy="ville", cascade={"persist"})
     */
    private $codePostal;

    /**
     * Constructor
     */
    public function __construct() {
        $this->codePostal = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom Le nom
     *
     * @return Ville
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

    /**
     * Add codePostal
     *
     * @param \Unipik\ArchitectureBundle\Entity\CodePostal $codePostal Le code postal
     *
     * @return Ville
     */
    public function addCodePostal(\Unipik\ArchitectureBundle\Entity\CodePostal $codePostal) {
        $this->codePostal[] = $codePostal;

        return $this;
    }

    /**
     * Remove codePostal
     *
     * @param \Unipik\ArchitectureBundle\Entity\CodePostal $codePostal Le code postal
     *
     * @return void
     */
    public function removeCodePostal(\Unipik\ArchitectureBundle\Entity\CodePostal $codePostal) {
        $this->codePostal->removeElement($codePostal);
    }

    /**
     * Get codePostal
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCodePostal() {
        return $this->codePostal;
    }

}
