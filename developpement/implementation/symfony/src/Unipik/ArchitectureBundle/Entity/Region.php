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
 * Region
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 *
 * @ORM\Table(name="region", indexes={@ORM\Index(name="IDX_F62F176A6E44244", columns={"pays_id"})})
 * @ORM\Entity
 */
class Region {

    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                               type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="region_id_seq", allocationSize=1, initialValue=1)
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
     * Le pays
     *
     * @var \Unipik\ArchitectureBundle\Entity\Pays
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Pays", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pays_id",                                      referencedColumnName="id")
     * })
     */
    private $pays;

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
     * @return Region
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
     * Set pays
     *
     * @param \Unipik\ArchitectureBundle\Entity\Pays $pays Le pays
     *
     * @return Region
     */
    public function setPays(\Unipik\ArchitectureBundle\Entity\Pays $pays) {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \Unipik\ArchitectureBundle\Entity\Pays
     */
    public function getPays() {
        return $this->pays;
    }
}
