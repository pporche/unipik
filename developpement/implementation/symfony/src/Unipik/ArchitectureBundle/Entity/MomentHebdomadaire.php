<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Unipik\ArchitectureBundle\DBAL\Types\JourType;
use Unipik\ArchitectureBundle\DBAL\Types\MomentQuotidienType;

/**
 * MomentHebdomadaire
 *
 * @ORM\Table(name="moment_hebdomadaire")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\MomentHebdomadaireRepository")
 */
class MomentHebdomadaire {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $_id;

     /**
     *
     * @ORM\Column(name="jour", type="JourType", nullable=false)
     * @DoctrineAssert\Enum(entity="Unipik\ArchitectureBundle\DBAL\Types\JourType")
     */
    private $_jour;

    /**
     *
     * @ORM\Column(name="moment", type="MomentQuotidienType", nullable=false)
     * @DoctrineAssert\Enum(entity="Unipik\ArchitectureBundle\DBAL\Types\MomentQuotidienType")
     */
    private $_moment;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set jour
     *
     * @param JourType $jour
     *
     * @return MomentHebdomadaire
     */
    public function setJour($jour) {
        $this->_jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return JourType
     */
    public function getJour() {
        return $this->_jour;
    }

    /**
     * Set moment
     *
     * @param MomentQuotidienType $moment
     *
     * @return MomentHebdomadaire
     */
    public function setMoment($moment) {
        $this->_moment = $moment;

        return $this;
    }

    /**
     * Get moment
     *
     * @return MomentQuotidienType
     */
    public function getMoment() {
        return $this->_moment;
    }
}
