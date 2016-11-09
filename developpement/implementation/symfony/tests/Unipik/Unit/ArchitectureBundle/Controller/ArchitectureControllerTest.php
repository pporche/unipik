<?php
///**
// * Created by PhpStorm.
// * User: mmartinsbaltar
// * Date: 03/10/16
// * Time: 08:43
// *
// * PHP version 5
// *
// * @category None
// * @package  Test\Unipik\Unit\ArchitectureBundle\Controller
// * @author   Matthieu Martins-Baltar <matthieu.martinsbaltar@insa-rouen.fr>
// * @license  None None
// * @link     None
// */
//
//namespace Test\Unipik\Unit\ArchitectureBundle\Controller;
//
//
//use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\InterventionRepositoryMock;
//use Unipik\ArchitectureBundle\Controller\ArchitectureController;
//use Tests\Unipik\Unit\Utils\ControllerTestCase;
//use Tests\Unipik\Unit\Utils\ContainerMock;
//
///**
// * Class ArchitectureControllerTest
// *
// * @category None
// * @package  Test\Unipik\Unit\ArchitectureBundle\Controller
// * @author   Matthieu Martins-Baltar <matthieu.martinsbaltar@insa-rouen.fr>
// * @license  None None
// * @link     None
// */
//class ArchitectureControllerTest extends ControllerTestCase
//{
//
//    /**
//     * Test the indexAction method when logged out
//     *
//     * @return null
//     */
//    public function testIndexActionAnonyme()
//    {
//        $controller = new ArchitectureController();
//        $containerMock = new ContainerMock();
//
//        $containerMock->expectGetUser();
//        $containerMock->expectRender('ArchitectureBundle::accueilAnonyme.html.twig');
//
//        $controller->setContainer($containerMock->getContainer());
//        $controller->indexAction();
//    }
//
//    /**
//     * Test the indexAction method when logged in
//     *
//     * @return null
//     */
//    public function testIndexActionConnecte()
//    {
//        $controller = new ArchitectureController();
//        $containerMock = new ContainerMock();
//
//        $user = new \FOS\UserBundle\Tests\TestUser();
//        $containerMock->expectGetUser($user);
//
//        $repositoryMock = new InterventionRepositoryMock();
//        $repositories = array(
//            "InterventionBundle:Intervention" => $repositoryMock->getRepository(),
//        );
//
//        $repositoryMock->expectQuery(
//            'getNInterventionsRealiseesOuNonBenevole',
//            'result1'
//        );
//        $repositoryMock->expectQuery(
//            'getNInterventionsRealiseesOuNonBenevole',
//            'result2'
//        );
//        $repositoryMock->expectQuery('getInterventionsRealiseesOuNon', 'result3');
//        $repositoryMock->expectQuery('getInterventionsRealiseesOuNon', 'result4');
//
//        $containerMock->expectGetManager($repositories);
//        $containerMock->expectRender(
//            'ArchitectureBundle::accueilBenevole.html.twig',
//            array(
//                'user' => $user,
//                'interventionsNonRealiseesBenevole' => 'result1',
//                'interventionsRealiseesBenevole'    => 'result2',
//                'interventionsNonRealisees'         => 'result3',
//                'interventionsRealisees'            => 'result4',
//            )
//        );
//
//        $controller->setContainer($containerMock->getContainer());
//        $controller->indexAction();
//    }
//
//    /**
//     * Test the noJSAction method
//     *
//     * @return null
//     */
//    public function testNoJSAction()
//    {
//        $controller = new ArchitectureController();
//        $containerMock = new ContainerMock();
//
//        $containerMock->expectRender('::noJavascript.html.twig');
//
//        $controller->setContainer($containerMock->getContainer());
//        $controller->noJSAction();
//    }
//
//    /**
//     * Test the AutocompleteVilleAction method
//     *
//     * @return null
//     */
//    public function testAutocompleteVilleAction()
//    {
//        $controller = new ArchitectureController();
//        $containerMock = new ContainerMock();
//
//        $containerMock->expectRender('::noJavascript.html.twig');
//
//        $controller->setContainer($containerMock->getContainer());
//        $controller->noJSAction();
//    }
//}
