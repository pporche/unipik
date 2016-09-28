<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 26/09/16
 * Time: 10:26
 */

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity
 */
class Ville
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ville_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\CodePostal", mappedBy="ville")
     */
    private $codePostal;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->codePostal = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Ville
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
     * Add codePostal
     *
     * @param \Unipik\ArchitectureBundle\Entity\CodePostal $codePostal
     *
     * @return Ville
     */
    public function addCodePostal(\Unipik\ArchitectureBundle\Entity\CodePostal $codePostal)
    {
        $this->codePostal[] = $codePostal;

        return $this;
    }

    /**
     * Remove codePostal
     *
     * @param \Unipik\ArchitectureBundle\Entity\CodePostal $codePostal
     */
    public function removeCodePostal(\Unipik\ArchitectureBundle\Entity\CodePostal $codePostal)
    {
        $this->codePostal->removeElement($codePostal);
    }

    /**
     * Get codePostal
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getcodePostal()
    {
        return $this->codePostal;
    }

}
