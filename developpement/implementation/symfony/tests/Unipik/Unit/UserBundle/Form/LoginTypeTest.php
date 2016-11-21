<?php
/**
 * Created by PhpStorm.
 * User: francois
 * Date: 11/10/16
 * Time: 08:49
 */

namespace Tests\Unipik\Unit\UserBundle\Form;

use Tests\Unipik\Unit\Utils\FormTestCase;
use Unipik\UserBundle\Form\LoginType;

class LoginTypeTest extends FormTestCase {

    protected static $testedType = LoginType::class;

    public function validDataProvider()
    {


        return [
            "login test" => [
                [
                    // input in form
                    '_username' => "admin",
                    '_password' => "admin",
                ],
                [
                    // expected result
                    '_username' => "admin",
                    '_password' => "admin",
                    '_remember_me' => false,
                ]
            ],
            "remember me" => [
                [
                    '_username' => "admin",
                    '_password' => "admin",
                    '_remember_me' => true,
                ],
                [
                    '_username' => "admin",
                    '_password' => "admin",
                    '_remember_me' => true,
                ]
            ],
        ];
    }

    public function badDataProvider()
    {
        return [
            "champ inexistant" => [[
                '_fake' => "fake",
            ]]

        ];
    }

}
