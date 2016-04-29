<?php

namespace Unipik\ArchitectureBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class JourType extends AbstractEnumType {
    const LUNDI    = 'lundi';
    const MARDI = 'mardi';
    const MERCREDI  = 'mercredi';
    const JEUDI  = 'jeudi';
    const VENDREDI = 'vendredi';

    protected static $choices = [
     self::LUNDI    => 'lundi',
     self::MARDI => 'mardi',
    self::MERCREDI  => 'mercredi',
    self::JEUDI  => 'jeudi',
    self::VENDREDI => 'vendredi'
    ];
}


