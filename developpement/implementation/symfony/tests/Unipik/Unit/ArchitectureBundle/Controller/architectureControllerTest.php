<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/10/16
 * Time: 08:43
 */

namespace Test\Unipik\Unit\ArchitectureBundle\Controller;


use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\InterventionRepositoryMock;
use Unipik\ArchitectureBundle\Controller\ArchitectureController;
use Tests\Unipik\Unit\Utils\ControllerTestCase;
use Tests\Unipik\Unit\Utils\ContainerMock;

class architectureControllerTest extends ControllerTestCase
{

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

        $repositoryMock->expectQuery('getNInterventionsRealiseesOuNonBenevole', 'result interventionsNonRealiseesBenevole');
        $repositoryMock->expectQuery('getNInterventionsRealiseesOuNonBenevole', 'result interventionsRealiseesBenevole');
        $repositoryMock->expectQuery('getInterventionsRealiseesOuNon', 'result interventionsNonRealisees');
        $repositoryMock->expectQuery('getInterventionsRealiseesOuNon', 'result interventionsRealisees');

        $containerMock->expectGetManager($repositories);
        $containerMock->expectRender(
            'ArchitectureBundle::accueilBenevole.html.twig', array(
            'user' => $user,
            'interventionsNonRealiseesBenevole' => 'result interventionsNonRealiseesBenevole',
            'interventionsRealiseesBenevole' => 'result interventionsRealiseesBenevole',
            'interventionsNonRealisees' => 'result interventionsNonRealisees',
            'interventionsRealisees' => 'result interventionsRealisees'
            )
        );

        $controller->setContainer($containerMock->getContainer());
        $controller->indexAction();
    }

    public function testNoJSAction()
    {
        $controller = new ArchitectureController();
        $containerMock = new ContainerMock();

        $containerMock->expectRender('::noJavascript.html.twig');

        $controller->setContainer($containerMock->getContainer());
        $controller->noJSAction();
    }

    public function testAutocompleteVilleAction()
    {
        $controller = new ArchitectureController();
        $containerMock = new ContainerMock();

        $containerMock->expectRender('::noJavascript.html.twig');

        $controller->setContainer($containerMock->getContainer());
        $controller->noJSAction();
    }


}
