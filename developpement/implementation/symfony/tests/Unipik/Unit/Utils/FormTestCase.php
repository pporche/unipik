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

use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Validator\ConstraintViolationList;

abstract class FormTestCase extends TypeTestCase
{

    protected static $testedType = \Symfony\Component\Form\AbstractType::class;
    protected static $testEntity = null;

    protected function getExtensions()
    {
        $validator  = \Symfony\Component\Validator\Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        return array(
            new ValidatorExtension($validator),
        );
    }

    public function validDataProvider()
    {
        return array();
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testSubmitValidData($data, $entity)
    {
        $form = $this->factory->create(static::$testedType);

        // submit the data to the form directly
        $form->submit($data);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($form->getData(), $entity);
        $this->assertTrue($form->isValid());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($data) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function badDataProvider()
    {
        return array();
    }

    /**
     * @dataProvider badDataProvider
     */
    public function testSubmitBadData($data)
    {
        $form = $this->factory->create(static::$testedType);

        // submit the data to the form directly
        $form->submit($data);

        $this->assertTrue($form->isSynchronized());
        $this->assertFalse($form->isValid());
    }
}
