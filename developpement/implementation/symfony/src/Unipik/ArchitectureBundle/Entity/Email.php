<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\EmailRepository")
 */
class Email {

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="id", type="string", length=100, unique=true)
     */
    private $_email;

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Email
     */
    public function setEmail($email) {
        $this->_email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->_email;
    }
}

