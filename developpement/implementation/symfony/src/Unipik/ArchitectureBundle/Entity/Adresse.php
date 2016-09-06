<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity
 */
class Adresse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adresse_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=100, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="rue", type="string", length=500, nullable=false)
     */
    private $rue;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", nullable=false)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_de_rue", type="string", length=15, nullable=false)
     */
    private $numeroDeRue;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=100, nullable=true)
     */
    private $complement;

    /**
     * @var string
     *
     * @ORM\Column(name="geolocalisation", type="string", length=255, nullable=true)
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
     * @param string $ville
     *
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set rue
     *
     * @param string $rue
     *
     * @return Adresse
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Adresse
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set numeroDeRue
     *
     * @param string $numeroDeRue
     *
     * @return Adresse
     */
    public function setNumeroDeRue($numeroDeRue)
    {
        $this->numeroDeRue = $numeroDeRue;

        return $this;
    }

    /**
     * Get numeroDeRue
     *
     * @return string
     */
    public function getNumeroDeRue()
    {
        return $this->numeroDeRue;
    }

    /**
     * Set complement
     *
     * @param string $complement
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
     * @param string $geolocalisation
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
