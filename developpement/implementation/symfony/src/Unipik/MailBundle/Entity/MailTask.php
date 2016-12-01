<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 *
 * PHP version 5
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MailBundle
 *
 * @ORM\Entity(repositoryClass="Unipik\MailBundle\Entity\MailTaskRepository")
 * @ORM\Table(name="mailtask")
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class MailTask {
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
     * Le nom
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * L'intervalle
     *
     * @ORM\Column(name="interval", type="integer")
     */
    private $interval;

    /**
     * Le dernier run
     *
     * @var \DateTime
     *
     * @ORM\Column(name="lastrun", type="datetime", nullable=true)
     */
    private $lastrun;

    /**
     * L'id de l'etablissement
     *
     * @ORM\Column(name="id_etablissement", type="array")
     */
    private $id_etablissement;

    /**
     * La date
     *
     * @var \DateTime
     *
     * @ORM\Column(name="date_insert", type="datetime", nullable=true)
     */
    private $date_insert;


    /**
     * Retourne l'id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Retourne le nom
     *
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set le nom
     *
     * @param string $name Le nom
     *
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Retourne l'intervalle
     *
     * @return mixed
     */
    public function getInterval() {
        return $this->interval;
    }

    /**
     * Set l'intervalle
     *
     * @param string $interval L'intervalle
     *
     * @return $this
     */
    public function setInterval($interval) {
        $this->interval = $interval;
        return $this;
    }

    /**
     * Retourne le dernier run
     *
     * @return \DateTime
     */
    public function getLastRun() {
        return $this->lastrun;
    }

    /**
     * Fixe le dernier run
     *
     * @param string $lastrun Le dernier run
     *
     * @return $this
     */
    public function setLastRun($lastrun) {
        $this->lastrun = $lastrun;
        return $this;
    }

    /**
     * Retourne la date d'insertion
     *
     * @return \DateTime
     */
    public function getDateInsert() {
        return $this->date_insert;
    }

    /**
     * Fixe la date d'insertion
     *
     * @param date $date_insert La date
     *
     * @return $this
     */
    public function setDateInsert($date_insert) {
        $this->date_insert = $date_insert;
        return $this;
    }

    /**
     * Retourne l'id de l'etablissement
     *
     * @return mixed
     */
    public function getIdEtablissement() {
        return $this->id_etablissement;
    }

    /**
     * Fixe l'id de l'etablissement
     *
     * @param int $id_etablissement L'id de l'etablissement
     *
     * @return $this
     */
    public function setIdEtablissement($id_etablissement) {
        $this->id_etablissement = $id_etablissement;
        return $this;
    }
}