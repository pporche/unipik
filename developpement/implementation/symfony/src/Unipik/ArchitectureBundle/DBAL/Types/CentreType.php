<?php

namespace Unipik\ArchitectureBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class CentreType extends AbstractEnumType
{
    const MATERNELLE = 'maternelle';
    const ELEMENTAIRE = 'elementaire';
    const ADOLESCENT = 'adolelescent';
    const AUTRE = 'autre';


    protected static $choices = [
        self::MATERNELLE => 'maternelle',
        self::ELEMENTAIRE => 'elementaire',
        self::ADOLESCENT => 'adolelescent',
        self::AUTRE => 'autre'
    ];
}


