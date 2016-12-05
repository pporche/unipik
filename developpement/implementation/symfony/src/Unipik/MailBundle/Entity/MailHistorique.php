<?php
/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 05/12/16
 * Time: 10:51
 */

namespace Unipik\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MailBundle
 *
 * @ORM\Entity(repositoryClass="Unipik\MailBundle\Entity\MailHistoriqueRepository")
 * @ORM\Table(name="mail_historique")
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class MailHistorique {

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
     * @ORM\Column(name="id_etablissement", type="integer", nullable=false)
     */
    private $id_etablissement;

    /**
     * La date
     *
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="datetime", nullable=true)
     */
    private $date_envoi;

    /**
     * Le type d'email
     *
     * @ORM\Column(name="type_email", type="string")
     */
    private $type_email;


    /**
     * Retourne l'id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnvoi() {
        return $this->date_envoi;
    }

    /**
     * @param \DateTime $date_envoi
     *
     * @return $this
     */
    public function setDateEnvoi($date_envoi) {
        $this->date_envoi = $date_envoi;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeEmail() {
        return $this->type_email;
    }

    /**
     * @param mixed $type_email
     *
     * @return $this
     */
    public function setTypeEmail($type_email) {
        $this->type_email = $type_email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdEtablissement() {
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
}