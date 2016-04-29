<?php

namespace Unipik\ArchitectureBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class AutreEtablissementType extends AbstractEnumType {
    const MAIRIE = 'mairie';
    const MAISONRET    = 'maison de retraite';
    const AUTRE  = 'autre';


    protected static $choices = [
     self::MAIRIE    => 'mairie',
     self::MAISONRET => 'maison de retraite',
     self::AUTRE  => 'autre'
    ];
}


