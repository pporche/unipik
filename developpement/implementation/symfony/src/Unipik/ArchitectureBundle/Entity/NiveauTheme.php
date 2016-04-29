<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use CoreBundle\DBAL\Types\NiveauScolaireCompletType;
use CoreBundle\DBAL\Types\ThemeType;

/**
 * NiveauTheme
 *
 * @ORM\Table(name="niveau_theme")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\NiveauThemeRepository")
 */
class NiveauTheme {

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
     * @ORM\Column(name="niveau", type="NiveauScolaireCompletType", nullable=false)
     * @DoctrineAssert\Enum(entity="CoreBundle\DBAL\Types\NiveauScolaireCompletType")     
     */
    private $_niveau;
    
    /**
     *
     * @ORM\Column(name="theme", type="ThemeType", nullable=false)
     * @DoctrineAssert\Enum(entity="CoreBundle\DBAL\Types\ThemeType")     
     */
    private $_theme;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set niveau
     *
     * @param NiveauScolaireCompletType $niveau
     *
     * @return NiveauTheme
     */
    public function setNiveau($niveau) {
        $this->_niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return NiveauScolaireCompletType
     */
    public function getNiveau() {
        return $this->_niveau;
    }

    /**
     * Set theme
     *
     * @param ThemeType $theme
     *
     * @return NiveauTheme
     */
    public function setTheme($theme) {
        $this->_theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return ThemeType
     */
    public function getTheme() {
        return $this->_theme;
    }
}
