<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 14/10/16
 * Time: 12:15
 */

namespace Tests\Unipik\Unit\Utils;


class RepositoryMock
{
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
}
