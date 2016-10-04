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

    public function testIndexAction()
    {
        $controller = new ArchitectureController();
        $container = $this->getMock("Symfony\\Component\\DependencyInjection\\ContainerInterface");

        $ctr = 0;
        $ctr = $this->expectGetUser($container, $ctr);
        $ctr = $this->expectRender($container, $ctr, 'ArchitectureBundle::accueilAnonyme.html.twig');


        $controller->setContainer($container);
        $controller->indexAction();
    }
}
