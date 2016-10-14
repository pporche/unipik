<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/10/16
 * Time: 08:43
 */

namespace Test\Unipik\Unit\ArchitectureBundle\Controller;


use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\InterventionRepositoryMock;
use Unipik\ArchitectureBundle\Controller\ArchitectureController;
use Tests\Unipik\Unit\Utils\ControllerTestCase;
use Tests\Unipik\Unit\Utils\ContainerMock;

class architectureControllerTest extends ControllerTestCase {

//    public function testIndexActionAnonyme()
//    {
//        $controller = new ArchitectureController();
//        $container = $this->getMock("Symfony\\Component\\DependencyInjection\\ContainerInterface");
//
//        $ctr = 0;
//        $ctr = $this->expectGetUser($container, $ctr);
//        $ctr = $this->expectRender($container, $ctr, 'ArchitectureBundle::accueilAnonyme.html.twig');
//
//
//        $controller->setContainer($container);
//        $controller->indexAction();
//    }


//    private function mockInterventionRepository() {
//        $repository = $this->mockRepository(array('getNInterventionsRealiseesOuNonBenevole'));
//
//        return $repository;
//    }


    public function testIndexActionConnecte()
    {
        $controller = new ArchitectureController();
        //$container = $this->getMock("Symfony\\Component\\DependencyInjection\\ContainerInterface");
        $containerMock = new ContainerMock();

        $user = new \FOS\UserBundle\Tests\TestUser();
            //new \FOS\UserBundle\Model\User();


        //$ctr = 0;
        //$ctr = $this->expectGetUser($container, $ctr, $user);
        $containerMock->expectGetUser($user);


        $repositoryMock = new InterventionRepositoryMock();
        $repository = $repositoryMock->getRepository();
        $repositories = array(
            "InterventionBundle:Intervention" => $repository
        );


        $repositoryMock->expectQuery('getNInterventionsRealiseesOuNonBenevole', 'expected result');
        $repositoryMock->expectQuery('getNInterventionsRealiseesOuNonBenevole', 'expected result');
        $repositoryMock->expectQuery('getInterventionsRealiseesOuNon', 'expected result');
        $repositoryMock->expectQuery('getInterventionsRealiseesOuNon', 'expected result');

        //$ctr = $this->expectGetManager($container, $repositories, $ctr);
        //$ctr = $this->expectRender($container, $ctr, 'ArchitectureBundle::accueilBenevole.html.twig', array('user' => $user));
        $containerMock->expectGetManager($repositories);
        $containerMock->expectRender('ArchitectureBundle::accueilBenevole.html.twig', array('user' => $user));

        //$controller->setContainer($container);
        $controller->setContainer($containerMock->getContainer());
        $controller->indexAction();
    }
}
