<?php
namespace CoreBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
 * Personne
 *
 * @ORM\Entity
 * @ORM\Table(name="personne")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"benevole" = "Benevole","contact"="Contact"}) 
 */
abstract class Personne {

    /**
     * @var string $email
     *
     * @ORM\Column(name="id", type="string", length=100, unique=true, nullable=false)
     * @ORM\Id
     * 
     */
    protected $email;
    
    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    protected $nom;
    
    /**
     * @var string $prenom
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=true)
     */
    protected $prenom;
    
    /**
     * @var string $telFixe
     *
     * @ORM\Column(name="tel_fixe", type="string", length=10, nullable=true)
     */
    protected $telFixe;
    
    /**
     * @var string $telPortable
     *
     * @ORM\Column(name="tel_portable", type="string", length=10, nullable=true)
     */
    protected $telPortable;

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
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
     * Get prenom
     *
     * @return string
     */
    public function getPrenom() {
        return $this->prenom;
    }

    /**
     * Get telFixe
     *
     * @return string
     */
    public function getTelFixe() {
        return $this->telFixe;
    }

    /**
     * Get telPortable
     *
     * @return string
     */
    public function getTelPortable() {
        return $this->telPortable;
    }

}
