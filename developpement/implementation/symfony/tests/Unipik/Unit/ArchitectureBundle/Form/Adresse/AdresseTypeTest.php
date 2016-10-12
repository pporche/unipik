<?php
///**
// * Created by PhpStorm.
// * User: mmartinsbaltar
// * Date: 23/09/16
// * Time: 16:43
// */
//
//namespace Tests\Unipik\Unit\ArchitectureBundle\Form\Adresse;
//
//use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
//use Symfony\Component\Form\PreloadedExtension;
//use Tests\Unipik\Unit\ArchitectureBundle\Entity\Mocks\AdresseMock;
//use Tests\Unipik\Unit\Utils\FormTestCase;
//use Unipik\ArchitectureBundle\Form\Adresse\AdresseType;
//
//class AdresseTypeTest extends FormTestCase {
//
//    protected static $testedType = AdresseType::class;
//    protected $entityManager;
//
//    protected function getExtensions()
//    {
//        $validator  = \Symfony\Component\Validator\Validation::createValidatorBuilder()
//            ->enableAnnotationMapping()
//            ->getValidator();
//
//        // create a type instance with the mocked dependencies
//        $r = new \ReflectionClass(static::$testedType);
//        $type = $r->newInstanceArgs(array($this->entityManager));
//
//        return array(
//            new ValidatorExtension($validator),
//            new PreloadedExtension(array($type), array()),
//        );
//    }
//
//    protected function setUp()
//    {
//        // mock any dependencies
//        $this->entityManager = $this->getMockBuilder('Doctrine\Common\Persistence\ObjectManager')->getMock();
////
////        $repoMock= $this->getMock('Doctrine\ORM\EntityRepository', array(), array(), '', false);
////
////        $this->entityManager
////            ->expects($this->atLeastOnce())
////            ->method('getRepository')
////            ->withAnyParameters()
////            ->will($this->returnValue($repoMock));
////
////        $repoMock
////            ->expects($this->atLeastOnce())
////            ->method('findOneBy')
////            ->withAnyParameters()
////            ->will($this->returnValue(AdresseMock::create()));
//
////        static::$kernel = static::createKernel();
////        static::$kernel->boot();
////        $this->entityManager = static::$kernel->getContainer()
////            ->get('doctrine')
////            ->getManager();
//
//        parent::setUp();
//    }
//
//    /**
//     * @dataProvider validDataProvider
//     */
//    public function testTransform($value, $transformed)
//    {
//        $this->assertEquals($transformed, $this->transformer->transform($value));
//    }
//
//    /**
//     * @dataProvider validDataProvider
//     */
//    public function testReverseTransform($value, $transformed)
//    {
//        $this->assertEquals($transformed, $this->transformer->reverseTransform($transformed));
//    }
//
//    public function validDataProvider()
//    {
//
////        $this->entityManager = $this->getMockBuilder('Doctrine\Common\Persistence\ObjectManager')->getMock();
////
////        $repoMock= $this->getMock('Doctrine\ORM\EntityRepository', array(), array(), '', false);
////
////        $this->entityManager
////            ->expects($this->atLeastOnce())
////            ->method('getRepository')
////            ->withAnyParameters()
////            ->will($this->returnValue($repoMock));
////
////        $repoMock
////            ->expects($this->atLeastOnce())
////            ->method('findOneBy')
////            ->withAnyParameters()
////            ->will($this->returnValue(AdresseMock::create()));
//
//
//
//        $a1 = AdresseMock::create();
//
//        return [
////        $formData = [
//            "Adresse ville et code postal" => [
//                "Ville" => [
//                    'adresse' => "22 rue du gros",
//                    'ville' => "Rouen",
//                    'codePostal' => "76000"
//                ],
//                $a1
//            ],
//        ];
//
////        $type = new AdresseType($this->entityManager);
////        $form = $this->factory->create($type);
////
////        $form->submit($formData);
//    }
//
//    public function badDataProvider()
//    {
//        return [
//            "Ville est null" => [
//                "Ville" => [
//                    'adresse' => [null, null, 14, "fred"], //array of stuff instead of string
//                    //'ville' => null,
//                    //'codePostal' => "76000"
//                ]
//            ],
//
//            "code postal est null" => [
//                "Ville" => [
//                    //'ville' => "Rouen"
//                ]
//            ],
//
//            "champs inexistant" => [
//                "Ville" => [
//                    //'ville' => "Rouen",
//                    //'codePostal' => "76000",
//                    'machin' => "truc"
//                ]
//            ],
//
//            "Adresse est null" => [
//                "Ville" => [
//                    //'ville' => "Rouen",
//                    //'codePostal' => "76000"
//                ]
//            ],
//        ];
//    }
//
//}
