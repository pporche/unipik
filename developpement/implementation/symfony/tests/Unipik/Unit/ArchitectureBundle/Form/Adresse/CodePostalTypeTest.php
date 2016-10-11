<?php
///**
// * Created by PhpStorm.
// * User: francois
// * Date: 10/10/16
// * Time: 18:01
// */
//
//namespace Tests\Unipik\Unit\UserBundle\Form;
//
//use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\CodePostalMock;
//use Tests\Unipik\Unit\Utils\FormTestCase;
//use Unipik\ArchitectureBundle\Entity\Departement;
//use Unipik\ArchitectureBundle\Entity\Pays;
//use Unipik\ArchitectureBundle\Entity\Region;
//use Unipik\ArchitectureBundle\Form\Adresse\CodePostalType;
//
//class CodePostalTypeTest extends FormTestCase {
//
//    protected static $testedType = CodePostalType::class;
//
//    public function validDataProvider()
//    {
//        $cp = CodePostalMock::createMultiple(2);
//
//        $p = new Pays();
//        $p  ->setNom("France");
//        $r = new Region();
//        $r  ->setNom("Normandie")
//            ->setPays($p);
//        $d = new Departement();
//        $d  ->setNom("Eure")
//            ->setNumero("27")
//            ->setRegion($r);
//
//        return [
//            "Code Postal minimum" => [
//                "Caca" => [
//                    'email' => "contact@bigcorp.eu",
//                    'nom' => "Dupond",
//                    //'typeContact' => 'enseignant'
//                ],
//                $cp
//            ],
//        ];
//    }
//
//    public function badDataProvider()
//    {
//        return [
//
//        ];
//    }
//
//}
