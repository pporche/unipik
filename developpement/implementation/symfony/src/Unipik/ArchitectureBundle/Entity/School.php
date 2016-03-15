<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * School
 *
 * @ORM\Table(name="school")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\SchoolRepository")
 */
class School
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="idEtablissement", type="integer", unique=true)
     */
    private $idEtablissement;

    /**
     * @var int
     *
     * @ORM\Column(name="nbEleve", type="integer")
     */
    private $nbEleve;

    /**
     * @var string
     *
     * @ORM\Column(name="chefEtablissement", type="string", length=100)
     */
    private $chefEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=100)
     */
    private $ville;


    /**
     * Get id
     *
     * @return int
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
     * @return School
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
     * Set idEtablissement
     *
     * @param integer $idEtablissement
     *
     * @return School
     */
    public function setIdEtablissement($idEtablissement)
    {
        $this->idEtablissement = $idEtablissement;

        return $this;
    }

    /**
     * Get idEtablissement
     *
     * @return int
     */
    public function getIdEtablissement()
    {
        return $this->idEtablissement;
    }

    /**
     * Set nbEleve
     *
     * @param integer $nbEleve
     *
     * @return School
     */
    public function setNbEleve($nbEleve)
    {
        $this->nbEleve = $nbEleve;

        return $this;
    }

    /**
     * Get nbEleve
     *
     * @return int
     */
    public function getNbEleve()
    {
        return $this->nbEleve;
    }

    /**
     * Set chefEtablissement
     *
     * @param string $chefEtablissement
     *
     * @return School
     */
    public function setChefEtablissement($chefEtablissement)
    {
        $this->chefEtablissement = $chefEtablissement;

        return $this;
    }

    /**
     * Get chefEtablissement
     *
     * @return string
     */
    public function getChefEtablissement()
    {
        return $this->chefEtablissement;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return School
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
}

