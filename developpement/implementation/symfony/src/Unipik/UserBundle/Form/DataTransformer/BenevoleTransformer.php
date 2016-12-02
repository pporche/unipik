<?php
/**
 * Created by PhpStorm.
 * User: Kafui
 * Date: 13/09/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\UserBundle\Form\DataTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Benevole transformer
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class BenevoleTransformer  implements DataTransformerInterface {
    private $entityManager;

    /**
     * VilleAutocompleteTransformer constructor.
     *
     * @param ObjectManager $entityManager Le manager
     *
     * @return object
     */
    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Return the string represetnation of a volunteer, his/her name
     *
     * @param mixed $benevole Le benevole
     *
     * @return string
     */
    public function transform($benevole) {
        if (null === $benevole) {
            return '';
        }

        return $benevole->getNom();
    }

    /**
     * Return the volunteer that has the name $benevoleNom
     *
     * @param mixed $benevoleNom Le nom du benevole
     *
     * @return Benevole|void
     */
    public function reverseTransform($benevoleNom) {
        if (!$benevoleNom) {
            return '';
        }

        $benevole = $this->entityManager
            ->getRepository('UserBundle:Benevole')->findOneBy(array('nom' => $benevoleNom));

        if (null === $benevole) {
            throw new TransformationFailedException(
                sprintf(
                    'There is no "%s" exists',
                    $benevoleNom
                )
            );
        }

        return $benevole;
    }

}
