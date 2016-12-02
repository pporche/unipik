<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 16/11/16
 * Time: 18:10
 *
 * PHP version 5
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\InterventionBundle\Form\DataTransformer\Etablissement;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class EtablissementAutocompleteTransformer
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class EtablissementAutocompleteTransformer implements DataTransformerInterface {
    private $entityManager;

    /**
     * DepartementAutocompleteTransformer constructor.
     *
     * @param ObjectManager $entityManager L'entity manager
     *
     * @return void
     */
    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Transformer
     *
     * @param mixed $etablissement L'établissement
     *
     * @return string
     */
    public function transform($etablissement) {
        if (null === $etablissement) {
            return '';
        }

        return $etablissement->getNom();
    }

    /**
     * Transformer inverse
     *
     * @param mixed $etablissementNom Le nom de l'établissement
     *
     * @return \Unipik\InterventionBundle\Entity\Etablissement|void
     */
    public function reverseTransform($etablissementNom) {
        if (!$etablissementNom) {
            return '';
        }

        $etablissement = $this->entityManager
            ->getRepository('InterventionBundle:Etablissement')->findOneBy(array('nom' => $etablissementNom));

        if (null === $etablissement) {
            throw new TransformationFailedException(
                sprintf(
                    'There is no "%s" exists',
                    $etablissementNom
                )
            );
        }

        return $etablissement;
    }

}
