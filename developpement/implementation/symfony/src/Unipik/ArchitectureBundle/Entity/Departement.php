<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 26/09/16
 * Time: 10:45
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
 * Departement
 *
 * @ORM\Table(name="departement")
 * @ORM\Entity
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class Departement {

    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                                    type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="departement_id_seq", allocationSize=1, initialValue=1)
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
     * Le numero
     *
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=30, nullable=false)
     */
    private $numero;

    /**
     * La region
     *
     * @var \Unipik\ArchitectureBundle\Entity\Region
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Region", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="region_id",                                      referencedColumnName="id")
     * })
     */
    private $region;

    /**
     * Le comite
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\UserBundle\Entity\Comite", inversedBy="departement", cascade={"persist"})
     * @ORM\JoinTable(name="comite_departement",
     *   joinColumns={
     *     @ORM\JoinColumn(name="departement_id",                          referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="comite_id",                               referencedColumnName="id")
     *   }
     * )
     */
    protected $comite;


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

    /**
     * Set numero
     *
     * @param string $numero Le numero
     *
     * @return Departement
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Set region
     *
     * @param \Unipik\ArchitectureBundle\Entity\Region $region La region
     *
     * @return Departement
     */
    public function setRegion(\Unipik\ArchitectureBundle\Entity\Region $region) {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Unipik\ArchitectureBundle\Entity\Region
     */
    public function getRegion() {
        return $this->region;
    }

    /**
     * Add comite
     *
     * @param \Unipik\UserBundle\Entity\Comite $comite Le comite
     *
     * @return Departement
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
    public function getComite() {
        return $this->comite;
    }

}
