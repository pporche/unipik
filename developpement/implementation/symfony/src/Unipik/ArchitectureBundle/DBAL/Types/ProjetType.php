<?php

namespace Unipik\ArchitectureBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class ProjetType extends AbstractEnumType
{
    const PRIMAIRE = 'primaire';
    const COLLEGE = 'college';
    const LYCEE = 'lycee';
    const SUP = 'superieur';


    protected static $choices = [
        self::PRIMAIRE => 'primaire',
        self::COLLEGE => 'college',
        self::LYCEE => 'lycee',
        self::SUP => 'superieur'
    ];
}


