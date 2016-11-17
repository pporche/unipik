<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 16/11/16
 * Time: 17:49
 */

namespace Unipik\ArchitectureBundle\Form\DataTransformer\Adresse;
use Doctrine\Common\Persistence\ObjectManager;
use Proxies\__CG__\Unipik\ArchitectureBundle\Entity\Departement;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


/**
 * Class DepartementAutocompleteTransformer
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class DepartementAutocompleteTransformer implements DataTransformerInterface {
    private $entityManager;

    /**
     * DepartementAutocompleteTransformer constructor.
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
     * @param mixed $departement Le département
     *
     * @return string
     */
    public function transform($departement)
    {
        if (null === $departement) {
            return '';
        }

        return $departement->getNom();
    }

    /**
     * Transformer inverse
     *
     * @param mixed $departementNom Le nom du département
     *
     * @return Departement|void
     */
    public function reverseTransform($departementNom)
    {
        if (!$departementNom) {
            return '';
        }

        $departement = $this->entityManager
            ->getRepository('ArchitectureBundle:Departement')->findOneBy(array('nom' => $departementNom));

        if (null === $departement) {
            throw new TransformationFailedException(
                sprintf(
                    'There is no "%s" exists',
                    $departementNom
                )
            );
        }

        return $departement;
    }

}
