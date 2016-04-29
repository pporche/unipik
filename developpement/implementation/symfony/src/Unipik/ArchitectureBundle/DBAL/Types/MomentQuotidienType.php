<?php 

namespace CoreBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class MomentQuotidienType extends AbstractEnumType {
    const MATIN    = 'matin';
    const APRESMIDI = 'apres-midi';
    const SOIR  = 'soir';
   

    protected static $choices = [
     self::MATIN    => 'matin',
     self::APRESMIDI => 'apres-midi',
    self::SOIR  => 'soir'
    ];
}


