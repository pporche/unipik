<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 16/03/16
 * Time: 09:31
 */



namespace Tests\Unipik\ArchitectureBundle\Entity;

use Unipik\ArchitectureBundle\Entity\Name;


class NameTest extends \PHPUnit_Framework_TestCase {

    public function testsetteurEtGetteur() {
        $nameTest = new Name();

        $nameTest->setName('Florian');
        $this->assertEquals($nameTest->getName(),'Florian');

    }


}
