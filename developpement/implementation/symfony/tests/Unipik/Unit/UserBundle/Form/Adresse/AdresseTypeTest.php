<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 16:43
 */

namespace Tests\Unipik\Unit\UserBundle\Form\Adresse;


use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Unipik\ArchitectureBundle\Entity\Adresse;
use Tests\Unipik\Unit\Utils\FormTestCase;
use Unipik\UserBundle\Form\Adresse\AdresseType;

class AdresseTypeTest extends FormTestCase {

    protected static $testedType = AdresseType::class;




    public function validDataProvider()
    {
        $a1 = AdresseMock::create();
        $a2 = clone $a1;
        $a2->setAdresse("58 rue bidule");

        return [
            "Ville et codePostal seulement" => [
                "Ville" => [
                    'ville' => "Rouen",
                    'codePostal' => "7600"
                ],
                $a1
            ],

            "Adresse ville et code postal" => [
                "Ville" => [
                    'adresse' => "58 rue bidule",
                    'ville' => "Rouen",
                    'codePostal' => "7600"
                ],
                $a2
            ],
        ];
    }

    public function badDataProvider()
    {
        $a1 = AdresseMock::create();
        $a2 = clone $a1;
        $a3 = clone $a1;

        return [
            "Ville est null" => [
                "Ville" => [
                    'adresse' => [null, null, 14, "fred"],
                    'ville' => null,
                    'codePostal' => "7600"
                ]
            ],

            "code postal est null" => [
                "Ville" => [
                    'ville' => "Rouen"
                ]
            ],

            "champs inexistant" => [
                "Ville" => [
                    'ville' => "Rouen",
                    'codePostal' => "7600",
                    'machin' => "truc"
                ]
            ],
        ];
    }

}
