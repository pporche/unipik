<?php

/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 28/09/16
 * Time: 14:59
 *
 * PHP version 5
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\ArchitectureBundle\Form\DataTransformer\Adresse;

use Doctrine\Common\Persistence\ObjectManager;
use Unipik\ArchitectureBundle\Entity\Ville;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class VilleAutocompleteTransformer
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class VilleAutocompleteTransformer implements DataTransformerInterface {

    private $entityManager;

    /**
     * VilleAutocompleteTransformer constructor.
     *
     * @param ObjectManager $entityManager L'entity manager
     *
     * @return void
     */
    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transformer
     *
     * @param mixed $ville La ville
     *
     * @return string
     */
    public function transform($ville)
    {
        if (null === $ville) {
            return '';
        }

        return $ville->getNom();
    }

    /**
     * Transformer inverse
     *
     * @param mixed $villeNom Le nom de la ville
     *
     * @return Ville|void
     */
    public function reverseTransform($villeNom)
    {
        if (!$villeNom) {
            return null;
        }

        $ville = $this->entityManager
            ->getRepository('ArchitectureBundle:Ville')->findOneBy(array('nom' => $villeNom));

        if (null === $ville) {
            throw new TransformationFailedException(
                sprintf(
                    'There is no "%s" exists',
                    $villeNom
                )
            );
        }

        return $ville;
    }
}
