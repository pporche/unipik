<?php

/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 28/09/16
 * Time: 14:59
 */

namespace Unipik\ArchitectureBundle\Form\DataTransformer\Adresse;

use Doctrine\Common\Persistence\ObjectManager;
use Unipik\ArchitectureBundle\Entity\Ville;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class VilleAutocompleteTransformer
 * @package Unipik\ArchitectureBundle\Form\DataTransformer\Adresse
 */
class VilleAutocompleteTransformer implements DataTransformerInterface
{
    private $entityManager;

    /**
     * VilleAutocompleteTransformer constructor.
     * @param ObjectManager $entityManager
     */
    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $ville
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
     * @param mixed $villeNom
     * @return Ville|void
     */
    public function reverseTransform($villeNom)
    {
        if (!$villeNom) {
            return '';
        }

        $ville = $this->entityManager
            ->getRepository('ArchitectureBundle:Ville')->findOneBy(array('nom' => $villeNom));

        if (null === $ville) {
            throw new TransformationFailedException(sprintf('There is no "%s" exists',
                $villeNom
            ));
        }

        return $ville;
    }
}
