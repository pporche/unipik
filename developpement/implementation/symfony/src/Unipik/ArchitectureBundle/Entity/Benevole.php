<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Unipik\ArchitectureBundle\Entity\Activite;
use Unipik\ArchitectureBundle\Entity\Personne;

/**
 * Benevole
 * @ORM\Entity
 * @ORM\Table(name="benevole")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="statut", type="string")
 * @ORM\DiscriminatorMap({"admregion" = "AdminRegion","admcomite"="AdminComite","admactivite"="AdminActivite","benevole"="Benevole"})
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\BenevoleRepository")
 */
class Benevole extends Personne {

     /**
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Adresse", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $adresse;

    /**
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Activite", cascade={"persist"})
     *
     */
    protected $activitesPotentielles;

    /**
     * @ORM\ManyToMany(targetEntity="Unipik\ArchitectureBundle\Entity\Comite")
     *
     */
    protected $comite;

    /**
     * @var string $mdp
     *
     * @ORM\Column(name="mdp", type="string", length=50, nullable=false)
     */
    protected $mdp;

     /**
     * Constructor
     */
    public function __construct() {
        $this->activitesPotentielles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Benevole
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Benevole
     */
    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Benevole
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * Set telFixe
     *
     * @param string $telFixe
     *
     * @return Benevole
     */
    public function setTelFixe($telFixe) {
        $this->telFixe = $telFixe;
        return $this;
    }

    /**
     * Set telPortable
     *
     * @param string $telPortable
     *
     * @return Benevole
     */
    public function setTelPortable($telPortable) {
        $this->telPortable = $telPortable;
        return $this;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return Benevole
     */
    public function setMdp($mdp) {
        $this->mdp = $mdp;
        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp() {
        return $this->mdp;
    }

    /**
     * Get comite
     *
     * @return \Unipik\ArchitectureBundle\Entity\Comite
     */
    public function getComite() {
        return $this->comite;
    }

    /**
     * Add activitesPotentielle
     *
     * @param \Unipik\ArchitectureBundle\Entity\Activite $activitesPotentielle
     *
     * @return Benevole
     */
    public function addActivitesPotentielle(\Unipik\ArchitectureBundle\Entity\Activite $activitesPotentielle) {
        $this->activitesPotentielles[] = $activitesPotentielle;
        return $this;
    }

    /**
     * Remove activitesPotentielle
     *
     * @param \Unipik\ArchitectureBundle\Entity\Activite $activitesPotentielle
     */
    public function removeActivitesPotentielle(\Unipik\ArchitectureBundle\Entity\Activite $activitesPotentielle) {
        $this->activitesPotentielles->removeElement($activitesPotentielle);
    }

    /**
     * Get activitesPotentielles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivitesPotentielles() {
        return $this->activitesPotentielles;
    }

    /**
     * Set adresse
     *
     * @param \Unipik\ArchitectureBundle\Entity\Adresse $adresse
     *
     * @return Benevole
     */
    public function setAdresse(\Unipik\ArchitectureBundle\Entity\Adresse $adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \Unipik\ArchitectureBundle\Entity\Adresse
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Add comite
     *
     * @param \Unipik\ArchitectureBundle\Entity\Comite $comite
     *
     * @return Benevole
     */
    public function addComite(\Unipik\ArchitectureBundle\Entity\Comite $comite) {
        $this->comite[] = $comite;

        return $this;
    }

    /**
     * Remove comite
     *
     * @param \Unipik\ArchitectureBundle\Entity\Comite $comite
     */
    public function removeComite(\Unipik\ArchitectureBundle\Entity\Comite $comite) {
        $this->comite->removeElement($comite);
    }


}
