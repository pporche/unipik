<?php
/**
 * Created by PhpStorm.
 * User: mbignoux
 * Date: 17/10/16
 * Time: 09:24
 */


// version 1.00 date 17/10/2016 auteur(s) Mélissa
namespace Unipik\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participe
 *
 * @ORM\Table(name="participe")
 * @ORM\Entity
 */

class Participe {
    /**
 * @Id @ManyToOne(targetEntity="Contact") 
*/
    private $contact;

    /**
 * @Id @ManyToOne(targetEntity="Projet) 
*/
    private $projet;

    /**
 * @Column(type="boolean) 
*/
    private $estTuteur;


    public function __construct(Contact $contact, Projet $projet, $estTuteur)
    {
        $this->contact = $contact;
        $this->projet = $projet;
        $this->estTuteur = $estTuteur;
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
     * Get contact
     *
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Get projet
     *
     * @return projet
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * Get estTuteur
     *
     * @return boolean
     */
    public function getEstTuteur()
    {
        return $this->estTuteur;
    }

    /**
     * Set estTuteur
     *
     * @return Participe
     */
    public function setEstTuteur($estTuteur)
    {
        $this->estTuteur = $estTuteur;

        return $this;
    }



}


