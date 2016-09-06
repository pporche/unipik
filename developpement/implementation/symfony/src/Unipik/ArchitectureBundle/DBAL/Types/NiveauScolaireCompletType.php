<?php

namespace Unipik\ArchitectureBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class NiveauScolaireCompletType extends AbstractEnumType
{
    const PETITESEC = 'petite section';
    const PSMS = 'petite-moyenne section';
    const MOYENNESEC = 'moyenne section';
    const MSGS = 'moyenne-grande section';
    const GRANDESEC = 'grande section';
    const PSMSGS = 'petite-moyenne-grande section';
    const CP = 'CP';
    const CPCE1 = 'CP-CE1';
    const CE1 = 'CE1';
    const CE1CE2 = 'CE1-CE2';
    const CE2 = 'CE2';
    const CE2CM1 = 'CE2-CM1';
    const CM1 = 'CM1';
    const CM1CM2 = 'CM1-CM2';
    const CM2 = 'CM2';
    const SIXEME = '6eme';
    const CINQEME = '5eme';
    const QUATREME = '4eme';
    const TROISEME = '3eme';
    const SECONDE = '2nde';
    const PREM = '1ere';
    const TERM = 'terminale';
    const LIC1 = 'L1';
    const LIC2 = 'L2';
    const LIC3 = 'L3';
    const MAS1 = 'M1';
    const MAS2 = 'M2';
    const AUTRE = 'autre';

    protected static $choices = [
        self::PETITESEC => 'petite section',
        self::PSMS => 'petite-moyenne section',
        self::MOYENNESEC => 'moyenne section',
        self::MSGS => 'moyenne-grande section',
        self::GRANDESEC => 'grande section',
        self::PSMSGS => 'petite-moyenne-grande section',
        self::CP => 'CP',
        self::CPCE1 => 'CP-CE1',
        self::CE1 => 'CE1',
        self::CE1CE2 => 'CE1-CE2',
        self::CE2 => 'CE2',
        self::CE2CM1 => 'CE2-CM1',
        self::CM1 => 'CM1',
        self::CM1CM2 => 'CM1-CM2',
        self::CM2 => 'CM2',
        self::SIXEME => '6eme',
        self::CINQEME => '5eme',
        self::QUATREME => '4eme',
        self::TROISEME => '3eme',
        self::SECONDE => '2nde',
        self::PREM => '1ere',
        self::TERM => 'terminale',
        self::LIC1 => 'L1',
        self::LIC2 => 'L2',
        self::LIC3 => 'L3',
        self::MAS1 => 'M1',
        self::MAS2 => 'M2',
        self::AUTRE => 'autre'
    ];
}


