<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 11:03
 */

namespace Tests\Unipik\Unit\UserBundle\Form;

use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Tests\Unipik\Unit\Utils\FormTestCase;
use Unipik\UserBundle\Form\ContactType;

class ContactTypeTest extends FormTestCase {

    protected static $testedType = ContactType::class;

    public function validDataProvider()
    {
        $c = ContactMock::createMultiple(4);

        $c[0]->setTypeContact(null);

        $c[1]->setTypeContact(null)
            ->setPrenom("Jean-Pierre")
            ->setTelFixe("0235123456")
            ->setTelPortable("0612345678");

        return [
            "Contact minimum" => [
                "Ville" => [
                    'email' => "contact@bigcorp.eu",
                    'nom' => "Dupond",
                    //'typeContact' => 'enseignant'
                ],
                $c[0]
            ],
            "Contact complet" => [
                "Ville" => [
                    'email' => "contact@bigcorp.eu",
                    'nom' => "Dupond",
                    //'typeContact' => 'enseignant',
                    'prenom' => 'Jean-Pierre',
                    'telFixe' => '0235123456',
                    'telPortable' => '0612345678'
                ],
                $c[1]
            ],
            /*"Contact avec type respo true" => [
                "Ville" => [
                    'email' => "contact@bigcorp.eu",
                    'nom' => "Dupond",
                    'typeContact' => 'enseignant',
                    'respoEtablissement' => true
                ],
                $c[2]
            ],
            "Contact avec type respo false" => [
                "Ville" => [
                    'email' => "contact@bigcorp.eu",
                    'nom' => "Dupond",
                    'typeContact' => 'enseignant',
                    'respoEtablissement' => false
                ],
                $c[3]
            ]*/
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
            "Contact with bad phone number" => [
                "Ville" => [
                    'email' => "contact@bigcorp.eu",
                    'nom' => "Dupond",
                    'telFixe' => "0612459893535152401"
                ]
            ],
            "Contact with bad cell phone number" => [
                "Ville" => [
                    'email' => "contact@bigcorp.eu",
                    'nom' => "Dupond",
                    'telPortable' => "0251"
                ]
            ],
            "Contact without 0 at the beginning of cell phone number" => [
                "Ville" => [
                    'email' => "contact@bigcorp.eu",
                    'nom' => "Dupond",
                    'telPortable' => "2511121212"
                ]
            ],
        ];
    }

}