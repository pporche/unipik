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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdEtablissement()
    {
        return $this->id_etablissement;
    }

    /**
     * @param mixed $id_etablissement
     *
     * @return $this
     */
    public function setIdEtablissement($id_etablissement) {
        $this->id_etablissement = $id_etablissement;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnvoi()
    {
        return $this->date_envoi;
    }

    /**
     * @param \DateTime $date_envoi
     *
     * @return $this
     */
    public function setDateEnvoi($date_envoi)
    {
        $this->date_envoi = $date_envoi;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeEmail()
    {
        return $this->type_email;
    }

    /**
     * @param mixed $type_email
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