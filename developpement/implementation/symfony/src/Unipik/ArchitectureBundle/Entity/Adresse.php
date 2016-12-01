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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class Adresse {

    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                                type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adresse_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * La ville
     *
     * @var               \Unipik\ArchitectureBundle\Entity\Ville
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Ville", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ville_id",                                      referencedColumnName="id" )
     * })
     */
    private $ville;

    /**
     * Le code postal
     *
     * @var               \Unipik\ArchitectureBundle\Entity\CodePostal
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\CodePostal", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_postal_id",                                     referencedColumnName="id" )
     * })
     */
    private $codePostal;

    /**
     * L'adresse
     *
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=500, nullable=false)
     */
    private $adresse;

    /**
     * Le complement
     *
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=100, nullable=true)
     */
    private $complement;

    /**
     * La geoloc
     *
     * @var string
     *
     * @ORM\Column(name="geolocalisation", type="geography", options={"geography_type"="POINT", "srid"=4326}, nullable=true)
     */
    private $geolocalisation;



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
     * Set ville
     *
     * @param \Unipik\ArchitectureBundle\Entity\Ville $ville La ville
     *
     * @return Adresse
     */
    public function setVille(\Unipik\ArchitectureBundle\Entity\Ville $ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \Unipik\ArchitectureBundle\Entity\Ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set code postal
     *
     * @param \Unipik\ArchitectureBundle\Entity\CodePostal $codePostal Le code postal
     *
     * @return Adresse
     */
    public function setCodePostal(\Unipik\ArchitectureBundle\Entity\CodePostal $codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get code Postal
     *
     * @return \Unipik\ArchitectureBundle\Entity\CodePostal
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }


    /**
     * Set adresse
     *
     * @param string $adresse L'adresse
     *
     * @return Adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }


    /**
     * Set complement
     *
     * @param string $complement Le complement
     *
     * @return Adresse
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set geolocalisation
     *
     * @param string $geolocalisation La geolocalisation
     *
     * @return Adresse
     */
    public function setGeolocalisation($geolocalisation)
    {
        $this->geolocalisation = $geolocalisation;

        return $this;
    }

    /**
     * Get geolocalisation
     *
     * @return string
     */
    public function getGeolocalisation()
    {
        return $this->geolocalisation;
    }
}
