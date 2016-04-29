<?php 

namespace CoreBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class EnseignementType extends AbstractEnumType {
    const MATERNELLE = 'maternelle';
    const PRIMAIRE    = 'primaire';
    const COLLEGE = 'college';
    const LYCEE  = 'lycee';
    const SUP  = 'superieur';
  

    protected static $choices = [
     self::MATERNELLE => 'maternelle',
     self::PRIMAIRE    => 'primaire',
     self::COLLEGE => 'college',
    self::LYCEE  => 'lycee',
    self::SUP  => 'superieur'
    ];
}


