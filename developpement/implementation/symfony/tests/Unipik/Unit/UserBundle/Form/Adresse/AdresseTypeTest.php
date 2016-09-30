<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 16:43
 */

namespace Tests\Unipik\Unit\UserBundle\Form\Adresse;

use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
use Tests\Unipik\Unit\Utils\FormTestCase;
use Unipik\UserBundle\Form\Adresse\AdresseType;

class AdresseTypeTest extends FormTestCase {

    protected static $testedType = AdresseType::class;

    public function validDataProvider()
    {
        $a1 = AdresseMock::create();

        return [
            "Adresse ville et code postal" => [
                "Ville" => [
                    'adresse' => "22 rue du gros",
                    'ville' => "Rouen",
                    'codePostal' => "76000"
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
                    'adresse' => [null, null, 14, "fred"],
                    'ville' => null,
                    'codePostal' => "76000"
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
                    'codePostal' => "76000",
                    'machin' => "truc"
                ]
            ],

            "Adresse est null" => [
                "Ville" => [
                    'ville' => "Rouen",
                    'codePostal' => "76000"
                ]
            ],
        ];
    }

}
