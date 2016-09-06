<?php

namespace Unipik\ArchitectureBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class NiveauScolaireLimiteType extends AbstractEnumType
{
    const CP = 'CP';
    const CPCE1 = 'CP-CE1';
    const CE1 = 'CE1';
    const CE1CE2 = 'CE1-CE2';
    const CE2 = 'CE2';
    const CE2CM1 = 'CE2-CM1';
    const CM1 = 'CM1';
    const CM1CM2 = 'CM1-CM2';
    const CM2 = 'CM2';
    const AUTRE = 'autre';

    protected static $choices = [
        self::CP => 'CP',
        self::CPCE1 => 'CP-CE1',
        self::CE1 => 'CE1',
        self::CE1CE2 => 'CE1-CE2',
        self::CE2 => 'CE2',
        self::CE2CM1 => 'CE2-CM1',
        self::CM1 => 'CM1',
        self::CM1CM2 => 'CM1-CM2',
        self::CM2 => 'CM2',
        self::AUTRE => 'autre'
    ];
}


