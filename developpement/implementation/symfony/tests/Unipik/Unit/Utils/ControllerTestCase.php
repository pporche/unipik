<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 03/10/16
 * Time: 15:32
 */

namespace Tests\Unipik\Unit\Utils;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTestCase extends WebTestCase {

    /**
     * @param PHPUnit_Framework_MockObject_MockObject $container
     * @param int $ctr
     * @return int
     */
    protected function expectGetUser($container, $ctr)
    {
        $tokenStorage = $this->getMock("Symfony\\Component\\Security\\Core\\Authentication\\Token\\Storage\\TokenStorageInterface");
        $token = $this->getMock("Symfony\\Component\\Security\\Core\\Authentication\\Token\\TokenInterface");
        $user = $this->getMockBuilder("Symfony\\Component\\Security\\Core\\User\\UserInterface")->disableOriginalConstructor()->getMock();
        $token->setUser($user);
        $tokenStorage->setToken($token);


        $container->expects($this->at($ctr++))
            ->method("has")
            ->with($this->equalTo("security.token_storage"))
            ->will($this->returnValue(true));
        $container->expects($this->at($ctr++))
            ->method("get")
            ->with($this->equalTo("security.token_storage"))
            ->will($this->returnValue($tokenStorage));

        return $ctr;
    }

    protected function expectRender($container, $ctr, $view, $parameters = array()){
        $twig = $this->getMock("Symfony\\Component\\Templating\\EngineInterface");

        $container->expects($this->at($ctr++))
            ->method("has")
            ->with($this->equalTo("templating"))
            ->will($this->returnValue(false))
        ;
        $container->expects($this->at($ctr++))
            ->method("has")
            ->with($this->equalTo("twig"))
            ->will($this->returnValue(true))
        ;
        $container->expects($this->at($ctr++))
            ->method("get")
            ->with($this->equalTo("twig"))
            ->will($this->returnValue($twig))
        ;
        $twig->expects($this->at(0))
            ->method("render")
            ->with($this->equalTo($view), $this->equalTo($parameters))
        ;


        return $ctr;
    }

}
