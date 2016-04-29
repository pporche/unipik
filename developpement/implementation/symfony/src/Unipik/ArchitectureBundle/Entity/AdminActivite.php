<?php

namespace ArchitectureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ArchitectureBundle\Entity\Benevole;

/**
 * AdminActivite
 *
 * @ORM\Entity
 * @ORM\Table(name="admin_activite")
 * @ORM\Entity(repositoryClass="ArchitectureBundle\Repository\AdminActiviteRepository")
 */

 class AdminActivite extends Benevole {

    /**
     * @ORM\ManyToMany(targetEntity="ArchitectureBundle\Entity\Activite", cascade={"persist"})
     */
    private $_responsableActivite;

    /**
     * Add responsableActivite
     *
     * @param \ArchitectureBundle\Entity\Activite $responsableActivite
     *
     * @return AdminActivite
     */
    public function addResponsableActivite(\ArchitectureBundle\Entity\Activite $responsableActivite) {
        $this->_responsableActivite[] = $responsableActivite;

        return $this;
    }

    /**
     * Remove responsableActivite
     *
     * @param \ArchitectureBundle\Entity\Activite $responsableActivite
     */
    public function removeResponsableActivite(\ArchitectureBundle\Entity\Activite $responsableActivite) {
        $this->_responsableActivite->removeElement($responsableActivite);
    }

    /**
     * Get responsableActivite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponsableActivite() {
        return $this->_responsableActivite;
    }

}
