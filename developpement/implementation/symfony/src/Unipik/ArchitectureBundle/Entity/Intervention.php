<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Intervention
 *
 * @ORM\Table(name="intervention")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\InterventionRepository")
 */
class Intervention
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
     * @ORM\Column(name="materielDispo", type="string", length=255)
     * @Assert\Length(max = 255)
     * @Assert\NotBlank()
     */
    private $materielDispo;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="string", length=255, nullable=true)
     * @Assert\Length(max = 255)
     */
    private $remarques;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 100)
     */
    private $lieu;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPersonnes", type="integer")
     * @Assert\Range(min = "1", max = "100000000")
     */
    private $nbPersonnes;

    /**
     * @var string
     *
     * @ORM\Column(name="moment", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 50)
     */
    private $moment;


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
     * Set materielDispo
     *
     * @param string $materielDispo
     *
     * @return Intervention
     */
    public function setMaterielDispo($materielDispo)
    {
        $this->materielDispo = $materielDispo;

        return $this;
    }

    /**
     * Get materielDispo
     *
     * @return string
     */
    public function getMaterielDispo()
    {
        return $this->materielDispo;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     *
     * @return Intervention
     */
    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;

        return $this;
    }

    /**
     * Get remarques
     *
     * @return string
     */
    public function getRemarques()
    {
        return $this->remarques;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Intervention
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set nbPersonnes
     *
     * @param integer $nbPersonnes
     *
     * @return Intervention
     */
    public function setNbPersonnes($nbPersonnes)
    {
        $this->nbPersonnes = $nbPersonnes;

        return $this;
    }

    /**
     * Get nbPersonnes
     *
     * @return int
     */
    public function getNbPersonnes()
    {
        return $this->nbPersonnes;
    }

    /**
     * Set moment
     *
     * @param string $moment
     *
     * @return Intervention
     */
    public function setMoment($moment)
    {
        $this->moment = $moment;

        return $this;
    }

    /**
     * Get moment
     *
     * @return string
     */
    public function getMoment()
    {
        return $this->moment;
    }
}

