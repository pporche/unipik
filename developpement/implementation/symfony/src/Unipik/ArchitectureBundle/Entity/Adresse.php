<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\AdresseRepository")
 */
class Adresse {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $_id;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=100)
     */
    private $_ville;

    /**
     * @var string
     *
     * @ORM\Column(name="rue", type="string", length=500)
     */
    private $_rue;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=5)
     */
    private $_codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_de_rue", type="string", length=10)
     */
    private $_numeroDeRue;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=100, nullable=true)
     */
    private $_complement;

    /**
     * @var string
     *
     * @ORM\Column(name="geolocalisation", type="string", length=255, nullable=true)
     */
    private $_geolocalisation;


    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Adresse
     */
    public function setVille($ville) {
        $this->_ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille() {
        return $this->_ville;
    }

    /**
     * Set rue
     *
     * @param string $rue
     *
     * @return Adresse
     */
    public function setRue($rue) {
        $this->_rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue() {
        return $this->_rue;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Adresse
     */
    public function setCodePostal($codePostal) {
        $this->_codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal() {
        return $this->_codePostal;
    }

    /**
     * Set numeroDeRue
     *
     * @param string $numeroDeRue
     *
     * @return Adresse
     */
    public function setNumeroDeRue($numeroDeRue) {
        $this->_numeroDeRue = $numeroDeRue;

        return $this;
    }

    /**
     * Get numeroDeRue
     *
     * @return string
     */
    public function getNumeroDeRue() {
        return $this->_numeroDeRue;
    }

    /**
     * Set complement
     *
     * @param string $complement
     *
     * @return Adresse
     */
    public function setComplement($complement) {
        $this->_complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement() {
        return $this->_complement;
    }

    /**
     * Set geolocalisation
     *
     * @param string $geolocalisation
     *
     * @return Adresse
     */
    public function setGeolocalisation($geolocalisation) {
        $this->_geolocalisation = $geolocalisation;

        return $this;
    }

    /**
     * Get geolocalisation
     *
     * @return string
     */
    public function getGeolocalisation() {
        return $this->_geolocalisation;
    }
}
