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

class CodePostaleTypeTest extends FormTestCase {

    protected static $testedType = AdresseType::class;
    protected static $testEntity = null; //AdresseMock::create();

    protected static function getTestEntity ($data) {
        //return Adresse::fromArray($data);
        return AdresseMock::create();
    }

    public function validDataProvider()
    {
        return [
            [
                "Ville" => [
                    'ville' => "Rouen",
                    'codePostal' => "7600"
                ]
            ]
        ];

            /*array(
            array(
                'data' => array(
                    'test' => 'test',
                    'test2' => 'test2',
                ),
            ),
            array(
                'data' => array(),
            ),
            array(
                'data' => array(
                    'test' => null,
                    'test2' => null,
                ),
            ),
        );*/
    }
}
