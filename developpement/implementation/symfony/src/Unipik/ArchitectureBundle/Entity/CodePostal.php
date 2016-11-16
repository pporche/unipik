<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 26/09/16
 * Time: 11:42
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
 * CodePostal
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 *
 * @ORM\Table(name="code_postal")
 * @ORM\Entity
 */
class CodePostal {

    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                                    type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="code_postal_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * Le code
     *
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=30, nullable=false)
     */
    private $code;

    /**
     * Le departement
     *
     * @var \Unipik\ArchitectureBundle\Entity\Departement
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Departement", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="departement_id",                                      referencedColumnName="id")
     * })
     */
    private $departement;

    /**
     * La ville
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitecturebundleBundle\Entity\Ville", inversedBy="codePostal", cascade={"persist"})
     * @ORM\JoinTable(name="ville_code_postal",
     *   joinColumns={
     *     @ORM\JoinColumn(name="code_postal_id",                                       referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ville_id",                                             referencedColumnName="id")
     *   }
     * )
     */
    protected $ville;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ville = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param string $code Le code
     *
     * @return CodePostal
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set departement
     *
     * @param \Unipik\ArchitectureBundle\Entity\Departement $departement Le departement
     *
     * @return Departement
     */
    public function setDepartement(\Unipik\ArchitectureBundle\Entity\Departement $departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \Unipik\ArchitectureBundle\Entity\Departement
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Add ville
     *
     * @param \Unipik\ArchitectureBundle\Entity\Ville $ville La ville
     *
     * @return CodePostal
     */
    public function addVille(\Unipik\ArchitectureBundle\Entity\Ville $ville)
    {
        $this->ville[] = $ville;

        return $this;
    }

    /**
     * Remove ville
     *
     * @param \Unipik\ArchitectureBundle\Entity\Ville $ville La ville
     *
     * @return void
     */
    public function removeVille(\Unipik\ArchitectureBundle\Entity\Ville $ville)
    {
        $this->ville->removeElement($ville);
    }

    /**
     * Get ville
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVille()
    {
        return $this->ville;
    }

}
