<?php
// version 1.00 date 13/05/2016 auteur(s) Michel Cressant, Julie Pain
namespace Unipik\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region", indexes={@ORM\Index(name="IDX_F62F176A6E44244", columns={"pays_id"})})
 * @ORM\Entity
 */
class Region
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="region_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=60, nullable=false)
     */
    private $nom;

    /**
     * @var \Unipik\UserBundle\Entity\Pays
     *
     * @ORM\ManyToOne(targetEntity="Unipik\UserBundle\Entity\Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pays_id", referencedColumnName="id")
     * })
     */
    private $pays;



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
     * @return Region
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
     * Set pays
     *
     * @param \Unipik\UserBundle\Entity\Pays $pays
     *
     * @return Region
     */
    public function setPays(\Unipik\UserBundle\Entity\Pays $pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \Unipik\UserBundle\Entity\Pays
     */
    public function getPays()
    {
        return $this->pays;
    }
}
