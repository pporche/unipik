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
use Unipik\ArchitectureBundle\Controller\ArchitectureController;
use Tests\Unipik\Unit\Utils\ControllerTestCase;

class architectureControllerTest extends ControllerTestCase {

    public function testIndexActionAnonyme()
    {
        $controller = new ArchitectureController();
        $container = $this->getMock("Symfony\\Component\\DependencyInjection\\ContainerInterface");

        $ctr = 0;
        $ctr = $this->expectGetUser($container, $ctr);
        $ctr = $this->expectRender($container, $ctr, 'ArchitectureBundle::accueilAnonyme.html.twig');


        $controller->setContainer($container);
        $controller->indexAction();
    }


    private function mockInterventionRepository() {
        $repository = $this->mockRepository(array('getNInterventionsRealiseesOuNonBenevole'));

        return $repository;
    }


    public function testIndexActionConnecte()
    {
        $controller = new ArchitectureController();
        $container = $this->getMock("Symfony\\Component\\DependencyInjection\\ContainerInterface");

        $user = new \FOS\UserBundle\Tests\TestUser();
            //new \FOS\UserBundle\Model\User();


        $ctr = 0;
        $ctr = $this->expectGetUser($container, $ctr, $user);


        $repository = $this->mockInterventionRepository();
        $repositories = array(
            "InterventionBundle:Intervention" => $repository
        );

        $rep_ctr = 0;
        $rep_ctr = $this->expectQuery($repository, 'getNInterventionsRealiseesOuNonBenevole', 'expected result', $rep_ctr);
        $rep_ctr = $this->expectQuery($repository, 'getNInterventionsRealiseesOuNonBenevole', 'expected result', $rep_ctr);

        $ctr = $this->expectGetManager($container, $repositories, $ctr);

        $ctr = $this->expectRender($container, $ctr, 'ArchitectureBundle::accueilBenevole.html.twig', array('user' => $user));


        $controller->setContainer($container);
        $controller->indexAction();
    }
}
