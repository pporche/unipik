<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 23/05/16
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
namespace Unipik\InterventionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * L'entity qui gère les ventes
 *
 * @ORM\Table(name="vente", indexes={@ORM\Index(name="IDX_888A2A4C8EAE3863", columns={"intervention_id"}), @ORM\Index(name="IDX_888A2A4CFF631228", columns={"etablissement_id"})})
 * @ORM\Entity
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class Vente
{
    /**
     * L'id
     *
     * @var integer
     *
     * @ORM\Column(name="id",                              type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="vente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * Le CA
     *
     * @var float
     *
     * @ORM\Column(name="chiffre_affaire", type="float", precision=10, scale=0, nullable=false)
     */
    private $chiffreAffaire;

    /**
     * La date de vente
     *
     * @var \DateTime
     *
     * @ORM\Column(name="date_vente", type="date", nullable=false)
     */
    private $dateVente;

    /**
     * Les remarques
     *
     * @var string
     *
     * @ORM\Column(name="remarques", type="string", length=500, nullable=true)
     */
    private $remarques;

    /**
     * L'intervention
     *
     * @var \Unipik\InterventionBundle\Entity\Intervention
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Intervention", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_id",                                      referencedColumnName="id")
     * })
     */
    private $intervention;

    /**
     * L'etablissement
     *
     * @var \Unipik\InterventionBundle\Entity\Etablissement
     *
     * @ORM\ManyToOne(targetEntity="Unipik\ArchitectureBundle\Entity\Etablissement", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etablissement_id",                                      referencedColumnName="id")
     * })
     */
    private $etablissement;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set chiffreAffaire
     *
     * @param float $chiffreAffaire Le CA
     *
     * @return Vente
     */
    public function setChiffreAffaire($chiffreAffaire)
    {
        $this->chiffreAffaire = $chiffreAffaire;

        return $this;
    }

    /**
     * Get chiffreAffaire
     *
     * @return float
     */
    public function getChiffreAffaire()
    {
        return $this->chiffreAffaire;
    }

    /**
     * Set date de vente
     *
     * @param \DateTime $date La date
     *
     * @return Vente
     */
    public function setDateVente($date)
    {
        $this->dateVente = $date;

        return $this;
    }

    /**
     * Get date de vente
     *
     * @return \DateTime
     */
    public function getDateVente()
    {
        return $this->dateVente;
    }

    /**
     * Set remarques
     *
     * @param string $remarques Les remarques
     *
     * @return Vente
     */
    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;

        return $this;
    }

    /**
     * Get remarques
     *
     * @return string
     */
    public function getRemarques()
    {
        return $this->remarques;
    }

    /**
     * Set intervention
     *
     * @param \Unipik\InterventionBundle\Entity\Intervention $intervention L'intervention
     *
     * @return Vente
     */
    public function setIntervention(Intervention $intervention = null)
    {
        $this->intervention = $intervention;

        return $this;
    }

    /**
     * Get intervention
     *
     * @return \Unipik\InterventionBundle\Entity\Intervention
     */
    public function getIntervention()
    {
        return $this->intervention;
    }

    /**
     * Set etablissement
     *
     * @param \Unipik\InterventionBundle\Entity\Etablissement $etablissement L'etablissement
     *
     * @return Vente
     */
    public function setEtablissement(Etablissement $etablissement)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \Unipik\InterventionBundle\Entity\Etablissement
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }
}
