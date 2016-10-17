<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 05/10/16
 * Time: 08:24
 */

namespace Tests\Unipik\Unit\ArchitectureBundle\Form\Adresse;

use Symfony\Component\HttpKernel\Tests\KernelTest;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;

class ArrayConverterTest extends KernelTest
{

    public function validDataProvider()
    {
        return array(
            "tableau vide" => array(
                "{}",
                array()
            ),
            "tableau d'un élement" => array(
                "{(element)}",
                array("element")
            ),
            "tableau de deux éléments" => array(
                "{(elm1),(elm2)}",
                array("elm1", "elm2")
            ),
            "tableau de deux tableaux de deux éléments" => array(
                "{{(e1),(e2)},{(e3),(e4)}}",
                array(array("e1", "e2"), array("e3", "e4"))
            ),
            "tableau des nombres" => array(
                "{(42)}",
                array(42)
            )
        );
    }

    /**
     * @dataProvider validDataProvider()
     */
    public function testPgtoPhp($data, $result)
    {
        $array = ArrayConverter::pgArrayToPhpArray($data);

        $this->assertEquals($result, $array);
    }

    /**
     * @dataProvider validDataProvider()
     */
    public function testPhptoPg($result, $data)
    {
        $array = ArrayConverter::phpArrayToPgArray($data);

        $this->assertEquals($result, $array);
    }


    public function addIntoPgArrayProvider()
    {
        return array(
            "chaine de caractère vide" => array(
                "",
                "element",
                "{(element)}"
            ),
            "tableau vide" => array(
                "{}",
                "element",
                "{(element)}"
            ),
            "tableau d'un élement" => array(
                "{(element)}",
                "element2",
                "{(element),(element2)}"
            ),
            "tableau de deux éléments" => array(
                "{(elm1),(elm2)}",
                "elm3",
                "{(elm1),(elm2),(elm3)}",
            ),
        //            "tableau de deux tableaux de deux éléments" => array(
        //                "{{(e1),(e2)},{(e3),(e4)}}",
        //                "{(e5),(e6)}",
        //                "{{(e1),(e2)},{(e3),(e4)},{(e5),(e6)}}"
        //            ),
            "tableau avec des nombres" => array(
                "{}",
                "42",
                "{(42)}",
            ),
        );
    }

    /**
     * @dataProvider addIntoPgArrayProvider()
     */
    public function testAddIntoPgArray($data, $element, $result)
    {
        $array = ArrayConverter::addIntoPgArray($data, $element);

        $this->assertEquals($result, $array);
    }

    /**
     * @dataProvider addIntoPgArrayProvider()
     */
    public function testRemoveFromPgArray($result, $element, $data)
    {
        $array = ArrayConverter::removeFromPgArray($data, $element);

        if($result != "") {
            $this->assertEquals($result, $array);
        }
    }

}
