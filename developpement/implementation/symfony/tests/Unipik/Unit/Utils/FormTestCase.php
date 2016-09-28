<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 23/09/16
 * Time: 16:44
 */

namespace Tests\Unipik\Unit\Utils;

use Symfony\Component\Form\Test\TypeTestCase;

//use AppBundle\Form\Type\TestedType;
//use AppBundle\Model\TestObject;

abstract class FormTestCase extends TypeTestCase {

    protected static $testedType = \Symfony\Component\Form\AbstractType::class;
    protected static $testEntity = null;

    /**
     * @dataProvider validDataProvider
     */
    public function testSubmitValidData($data)
    {

        $form = $this->factory->create(static::$testedType);

        $object = static::getTestEntity($data);

        // submit the data to the form directly
        $form->submit($data);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($data) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function validDataProvider()
    {
        return array();
    }
}
