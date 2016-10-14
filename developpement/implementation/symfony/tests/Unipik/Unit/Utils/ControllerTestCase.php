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
    protected function expectGetUser($container, $ctr, $user = null)
    {
        $tokenStorage = $this->getMock("Symfony\\Component\\Security\\Core\\Authentication\\Token\\Storage\\TokenStorageInterface");
        $token = $this->getMock("Symfony\\Component\\Security\\Core\\Authentication\\Token\\TokenInterface");
        if (is_null($user)) {
            $user = $this->getMock("Symfony\\Component\\Security\\Core\\User\\UserInterface");/*->disableOriginalConstructor()*/
            //->getMock();
        }
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

        $tokenStorage->expects($this->once())
            ->method("getToken")
            ->will($this->returnValue($token));

        $token->expects($this->once())
            ->method("getUser")
            ->will($this->returnValue($user));

        return $ctr;
    }

    protected function expectGetManager($container, $repositories, $ctr)
    {
        /**
         * Now mock the EntityManager that will return the aforementioned
         * Repository. Extend to more repositories with a returnValueMap or
         * with clauses in case you need to handle more than one repository.
         *
         * @var \Doctrine\ORM\EntityManager
         */
        $entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('getRepository'))
            ->disableOriginalConstructor()
            ->getMock();

        foreach ($repositories as $entity => $repository) {
            $entityManager
                ->expects($this->once())
                ->method('getRepository')
                ->with($entity)
                ->will($this->returnValue($repository));
        }

        $registry = $this
        ->getMockBuilder("Doctrine\\Bundle\\DoctrineBundle\\Registry")
        ->setMethods(array('getManager'))
        ->disableOriginalConstructor()
        ->getMock();

        $registry
            ->expects($this->once())
            ->method("getManager")
            ->will($this->returnValue($entityManager));

        $container->expects($this->at($ctr++))
            ->method("has")
            ->with($this->equalTo("doctrine"))
            ->will($this->returnValue(true));
        $container->expects($this->at($ctr++))
            ->method("get")
            ->with($this->equalTo("doctrine"))
            ->will($this->returnValue($registry));

        return $ctr;
    }

    protected function mockRepository($methods) {

        /**
         * Infering that the the Subject Under Test is dealing with a single
         * repository.
         *
         * @var \Doctrine\ORM\EntityRepository
         */
        $repository = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();

        return $repository;

    }

    protected function expectQuery($repository, $query, $expectedResult, $ctr) {


        $repository
            ->expects($this->at($ctr))
            ->method($query)
            ->will($this->returnValue($expectedResult));


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
