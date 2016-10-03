<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 29/09/16
 * Time: 11:08
 */

namespace Unipik\UserBundle\Form\DataTransformer\Adresse;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class CodePostalAutoCompleteTransformer
 * @package Unipik\UserBundle\Form\DataTransformer\Adresse
 */
class CodePostalAutoCompleteTransformer implements DataTransformerInterface
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
     * @param $codePostal
     * @return string
     */
    public function transform($codePostal)
    {
        if (null === $codePostal) {
            return '';
        }

        return $codePostal->getCode();
    }

    /**
     * @param $codePostalNumero
     * @return \Unipik\ArchitectureBundle\Entity\CodePostal|void
     */
    public function reverseTransform($codePostalNumero)
    {
        if (!$codePostalNumero) {
            return;
        }

        $codePostal = $this->entityManager
            ->getRepository('ArchitectureBundle:CodePostal')->findOneBy(array('code' => $codePostalNumero));

        if (null === $codePostal) {
            throw new TransformationFailedException(sprintf('There is no "%s" exists',
                $codePostalNumero
            ));
        }

        return $codePostal;
    }

}
