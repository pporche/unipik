<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 16:43
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Form\Adresse;

use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\PreloadedExtension;
use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\Utils\FormTestCase;
use Unipik\ArchitectureBundle\Form\Adresse\AdresseType;

class AdresseTypeTest extends FormTestCase {

    protected static $testedType = AdresseType::class;
    protected $entityManager;

    protected function getExtensions()
    {
        $validator  = \Symfony\Component\Validator\Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        // create a type instance with the mocked dependencies
        $r = new \ReflectionClass(static::$testedType);
        $type = $r->newInstanceArgs(array($this->entityManager));

        return array(
            new ValidatorExtension($validator),
            new PreloadedExtension(array($type), array()),
        );
    }

    protected function setUp()
    {
        // mock any dependencies
        $this->entityManager = $this->getMockBuilder('Doctrine\Common\Persistence\ObjectManager')->getMock();

        parent::setUp();
    }

    public function validDataProvider()
    {
        $a1 = AdresseMock::create();

        return [
            "Adresse ville et code postal" => [
                "Ville" => [
                    'adresse' => "22 rue du gros",
                    //'ville' => "Rouen",
                    //'codePostal' => "76000"
                ],
                $a1
            ],
        ];
    }

    public function badDataProvider()
    {
        return [
            "Ville est null" => [
                "Ville" => [
                    'adresse' => [null, null, 14, "fred"], //array of stuff instead of string
                    //'ville' => null,
                    //'codePostal' => "76000"
                ]
            ],

            "code postal est null" => [
                "Ville" => [
                    //'ville' => "Rouen"
                ]
            ],

            "champs inexistant" => [
                "Ville" => [
                    //'ville' => "Rouen",
                    //'codePostal' => "76000",
                    'machin' => "truc"
                ]
            ],

            "Adresse est null" => [
                "Ville" => [
                    //'ville' => "Rouen",
                    //'codePostal' => "76000"
                ]
            ],
        ];
    }

}
