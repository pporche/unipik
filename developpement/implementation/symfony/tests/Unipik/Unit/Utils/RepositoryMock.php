<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 14/10/16
 * Time: 12:15
 */

namespace Tests\Unipik\Unit\Utils;


use Doctrine\ORM\EntityRepository;

class RepositoryMock extends \PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    private $ctr;

    /**
     * @var EntityRepository|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $repository;

    protected $mockObjectGenerator;


    function __construct()
    {
        parent::__construct();
        $this->ctr = 0;
    }

    function getRepository()
    {
        return $this->repository;
    }


    protected function mockRepository($methods)
    {

        /**
         * Infering that the the Subject Under Test is dealing with a single
         * repository.
         *
         * @var EntityRepository
         */
        $this->repository = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();

        return $this;
    }

    public function expectQuery($query, $result) {
        $this->repository
            ->expects($this->at($this->ctr++))
            ->method($query)
            ->will($this->returnValue($result));

        return $this;
    }
}
