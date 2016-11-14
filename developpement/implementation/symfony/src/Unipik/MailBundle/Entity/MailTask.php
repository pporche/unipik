<?php

namespace Unipik\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 08/11/16
 * Time: 10:10
 */
/**
 * @ORM\Entity(repositoryClass="Unipik\MailBundle\Entity\MailTaskRepository")
 * @ORM\Table(name="mailtask")
 */
class MailTask {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\Column(name="interval", type="integer")
     */
    private $interval;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastrun", type="datetime", nullable=true)
     */
    private $lastrun;

    /**
     * @ORM\Column(name="id_etablissement", type="array")
     */
    private $id_etablissement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_insert", type="datetime", nullable=true)
     */
    private $date_insert;


    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getInterval() {
        return $this->interval;
    }

    public function setInterval($interval) {
        $this->interval = $interval;
        return $this;
    }

    public function getLastRun() {
        return $this->lastrun;
    }

    public function setLastRun($lastrun) {
        $this->lastrun = $lastrun;
        return $this;
    }

    public function getDateInsert() {
        return $this->date_insert;
    }

    public function setDateInsert($date_insert) {
        $this->date_insert = $date_insert;
        return $this;
    }

    public function getIdEtablissement() {
        return $this->id_etablissement;
    }

    public function setIdEtablissement($id_etablissement) {
        $this->id_etablissement = $id_etablissement;
        return $this;
    }
}