<?php

namespace App\Models;

abstract class CompanySize
{
    const STARTUP = 'STARTUP';
    const MEDIUM = 'MEDIUM';
    const BIG = 'BIG';

    const OPTIONS = [
        self::STARTUP,
        self::MEDIUM,
        self::BIG
    ];
}
