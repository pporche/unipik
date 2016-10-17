<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 14/10/16
 * Time: 14:12
 */

namespace Tests\Unipik\Unit\Utils;


class ContainerMock extends \PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    private $ctr;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $container;

    function __construct()
    {
        parent::__construct();
        $this->ctr = 0;

        $this->container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param $user
     */
    public function expectGetUser($user = null)
    {
        $tokenStorage = $this->getMock('Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface');
        $token = $this->getMock('Symfony\Component\Security\Core\Authentication\Token\TokenInterface');
        if (is_null($user)) {
            $user = $this->getMock('Symfony\Component\Security\Core\User\UserInterface');/*->disableOriginalConstructor()*/
            //->getMock();
        }
        $token->setUser($user);
        $tokenStorage->setToken($token);


        $this->container->expects($this->at($this->ctr++))
            ->method('has')
            ->with($this->equalTo('security.token_storage'))
            ->will($this->returnValue(true));
        $this->container->expects($this->at($this->ctr++))
            ->method('get')
            ->with($this->equalTo('security.token_storage'))
            ->will($this->returnValue($tokenStorage));

        $tokenStorage->expects($this->once())
            ->method('getToken')
            ->will($this->returnValue($token));

        $token->expects($this->once())
            ->method('getUser')
            ->will($this->returnValue($user));

    }

    public function expectGetManager($repositories)
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
            ->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
            ->setMethods(array('getManager'))
            ->disableOriginalConstructor()
            ->getMock();

        $registry
            ->expects($this->once())
            ->method('getManager')
            ->will($this->returnValue($entityManager));

        $this->container->expects($this->at($this->ctr++))
            ->method('has')
            ->with($this->equalTo('doctrine'))
            ->will($this->returnValue(true));
        $this->container->expects($this->at($this->ctr++))
            ->method('get')
            ->with($this->equalTo('doctrine'))
            ->will($this->returnValue($registry));

    }

    public function expectRender($view, $parameters = array())
    {
        $twig = $this->getMock('Symfony\Component\Templating\EngineInterface');

        $this->container->expects($this->at($this->ctr++))
            ->method('has')
            ->with($this->equalTo('templating'))
            ->will($this->returnValue(false));
        $this->container->expects($this->at($this->ctr++))
            ->method('has')
            ->with($this->equalTo('twig'))
            ->will($this->returnValue(true));
        $this->container->expects($this->at($this->ctr++))
            ->method('get')
            ->with($this->equalTo('twig'))
            ->will($this->returnValue($twig));
        $twig->expects($this->at(0))
            ->method('render')
            ->with($this->equalTo($view), $this->equalTo($parameters));

    }
}
