<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(max = 50)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="nbEleve", type="integer")
     * @Assert\Range(min = "1", max = "100000000")
     */
    private $nbEleve;

    /**
     * @var string
     *
     * @ORM\Column(name="chefEtablissement", type="string", length=100)
     * @Assert\Length(max = 50)
     * @Assert\NotBlank()
     */
    private $chefEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=100)
     * @Assert\Length(max = 100)
     * @Assert\NotBlank()
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

