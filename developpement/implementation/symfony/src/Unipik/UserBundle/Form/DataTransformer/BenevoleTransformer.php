<?php

namespace Unipik\UserBundle\Form\DataTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 05/10/16
 * Time: 18:32
 */
class BenevoleTransformer  implements DataTransformerInterface
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
     * Return the string represetnation of a volunteer, his/her name
     *
     * @param mixed $benevole
     * @return string
     */
    public function transform($benevole)
    {
        if (null === $benevole) {
            return '';
        }

        return $benevole->getNom();
    }

    /**
     * Return the volunteer that has the name $benevoleNom
     *
     * @param mixed $benevoleNom
     * @return Benevole|void
     */
    public function reverseTransform($benevoleNom)
    {
        if (!$benevoleNom) {
            return '';
        }

        $benevole = $this->entityManager
            ->getRepository('UserBundle:Benevole')->findOneBy(array('nom' => $benevoleNom));

        if (null === $benevole) {
            throw new TransformationFailedException(sprintf('There is no "%s" exists',
                $benevoleNom
            ));
        }

        return $benevole;
    }

}
