<?php

namespace Unipik\ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Unipik\ArchitectureBundle\DBAL\Types\MaterielPlaidoyerType;

/**
 * MaterielPlaidoyer
 * @ORM\Entity
 * @ORM\Table(name="materiel_plaidoyer")
 * @ORM\Entity(repositoryClass="Unipik\ArchitectureBundle\Repository\MaterielPlaidoyerRepository")
 */
class MaterielPlaidoyer {

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
     *
     *
     * @ORM\Column(name="materiel_plaidoyer", type="MaterielPlaidoyerType")
     * @DoctrineAssert\Enum(entity="Unipik\ArchitectureBundle\DBAL\Types\MaterielPlaidoyerType")
     */
    private $materielPlaidoyer;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

}
