<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 09/09/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Le repository qui gère les interventions
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

class MailHistorique{

    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                   type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $id;

    /**
     * L'id de l'etablissement
     *
     * @ORM\Column(name="id_etablissement", type="array")
     */

    private $id_etablissement;

    /**
     * Date d'envoi de mail
     *
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="datetime", nullable=true)
     */
    private $date_envoi;

    /**
     * Le type de mail
     *
     * @ORM\Column(name="type_email", type="string")
     */
    private $type_email;

    /**
     * Renvoie l'id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set l'id
     *
     * @param int $id L'id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Renvoie l'id de l'etablissement
     *
     * @return mixed
     */
    public function getIdEtablissement()
    {
        return $this->id_etablissement;
    }

    /**
     * Set l'id de l'etablissement
     *
     * @param mixed $id_etablissement L'id de l'etablissement
     *
     * @return $this
     */
    public function setIdEtablissement($id_etablissement) {
        $this->id_etablissement = $id_etablissement;
        return $this;
    }

    /**
     * Renvoie la date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set la date
     *
     * @param \DateTime $date La date
     *
     * @return $this
     */
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    /**
     * Renvoie la date d'envoi
     *
     * @return \DateTime
     */
    public function getDateEnvoi()
    {
        return $this->date_envoi;
    }

    /**
     * Set la date d'envoi
     *
     * @param \DateTime $date_envoi La date d'envoi
     *
     * @return $this
     */
    public function setDateEnvoi($date_envoi)
    {
        $this->date_envoi = $date_envoi;
        return $this;
    }

    /**
     * Renvoie le type de mail
     *
     * @return mixed
     */
    public function getTypeEmail()
    {
        return $this->type_email;
    }

    /**
     * Set le type de mail
     *
     * @param mixed $type_email Le type de mail
     *
     * @return $this
     */
    public function setTypeEmail($type_email)
    {
        $this->type_email = $type_email;
        return $this;
    }


}


?>