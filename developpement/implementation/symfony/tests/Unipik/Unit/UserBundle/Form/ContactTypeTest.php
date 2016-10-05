<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 11:03
 */

namespace Tests\Unipik\Unit\UserBundle\Form\Adresse;

use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Tests\Unipik\Unit\Utils\FormTestCase;
use Unipik\UserBundle\Form\ContactType;

class ContactTypeTest extends FormTestCase {

    protected static $testedType = ContactType::class;

    public function validDataProvider()
    {
        $c = ContactMock::create();
        $c->setTypeContact(null);

        return [
            "Contact minimum" => [
                "Ville" => [
                    'email' => "contact@bigcorp.eu",
                    'nom' => "Dupond",
                    //'typeContact' => 'enseignant'
                ],
                $c
            ],
        ];
    }

    public function badDataProvider()
    {
        return [
            "Contact with bad email" => [
                "Ville" => [
                    'email' => "contact...bigcorp.eu",
                    'nom' => "Dupond",
                ]
            ],
        ];
    }

}
