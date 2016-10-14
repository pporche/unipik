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

    public function testIndexActionAnonyme()
    {
        $controller = new ArchitectureController();
        $containerMock = new ContainerMock();

        $containerMock->expectGetUser();
        $containerMock->expectRender('ArchitectureBundle::accueilAnonyme.html.twig');

        $controller->setContainer($containerMock->getContainer());
        $controller->indexAction();
    }

    public function testIndexActionConnecte()
    {
        $controller = new ArchitectureController();
        $containerMock = new ContainerMock();

        $user = new \FOS\UserBundle\Tests\TestUser();
        $containerMock->expectGetUser($user);

        $repositoryMock = new InterventionRepositoryMock();
        $repositories = array(
            "InterventionBundle:Intervention" => $repositoryMock->getRepository()
        );

        $repositoryMock->expectQuery('getNInterventionsRealiseesOuNonBenevole', 'expected result');
        $repositoryMock->expectQuery('getNInterventionsRealiseesOuNonBenevole', 'expected result');
        $repositoryMock->expectQuery('getInterventionsRealiseesOuNon', 'expected result');
        $repositoryMock->expectQuery('getInterventionsRealiseesOuNon', 'expected result');

        $containerMock->expectGetManager($repositories);
        $containerMock->expectRender('ArchitectureBundle::accueilBenevole.html.twig', array(
            'user' => $user,
            'interventionsNonRealiseesBenevole' => 'expected result',
            'interventionsRealiseesBenevole' => 'expected result',
            'interventionsNonRealisees' => 'expected result',
            'interventionsRealisees' => 'expected result'
        ));

        $controller->setContainer($containerMock->getContainer());
        $controller->indexAction();
    }
}
