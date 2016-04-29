<?php 

namespace CoreBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class MaterielFrimousseType extends AbstractEnumType {
    const PATRON    = 'patron';
    const BOURRE = 'bourre';
    const DECO  = 'decoration';

    protected static $choices = [
     self::PATRON    => 'patron',
     self::BOURRE => 'bourre',
    self::DECO  => 'decoration'
    ];
}


