<?php

namespace Unipik\ArchitectureBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class MaterielPlaidoyerType extends AbstractEnumType
{
    const VIDEOPJT = 'video-projecteur';
    const TABLEAUINT = 'tableau interactif';
    const ENCEINTE = 'enceinte';
    const AUTRE = 'autre';

    protected static $choices = [
        self::VIDEOPJT => 'video-projecteur',
        self::TABLEAUINT => 'tableau interactif',
        self::ENCEINTE => 'enceinte',
        self::AUTRE => 'autre'
    ];
}


