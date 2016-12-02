<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 29/09/16
 * Time: 11:08
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
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class CodePostalAutoCompleteTransformer
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class CodePostalAutoCompleteTransformer implements DataTransformerInterface {

    private $entityManager;

    /**
     * VilleAutocompleteTransformer constructor.
     *
     * @param ObjectManager $entityManager Le manager
     *
     * @return void
     */
    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Transformer
     *
     * @param string $codePostal Le code postal
     *
     * @return string
     */
    public function transform($codePostal) {
        if (null === $codePostal) {
            return '';
        }

        return $codePostal->getCode();
    }

    /**
     * Transformer inverse
     *
     * @param int $codePostalNumero Le code postal
     *
     * @return \Unipik\ArchitectureBundle\Entity\CodePostal|void
     */
    public function reverseTransform($codePostalNumero) {
        if (!$codePostalNumero) {
            return null;
        }

        $codePostal = $this->entityManager
            ->getRepository('ArchitectureBundle:CodePostal')->findOneBy(array('code' => $codePostalNumero));

        if (null === $codePostal) {
            throw new TransformationFailedException(
                sprintf(
                    'There is no "%s" exists',
                    $codePostalNumero
                )
            );
        }

        return $codePostal;
    }

}
