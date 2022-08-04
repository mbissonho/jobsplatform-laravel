<?php

namespace App\Models;

abstract class ExperienceLevel
{
    const JUNIOR = 'JUNIOR';
    const MIDLEVEL = 'MIDLEVEL';
    const SENIOR = 'SENIOR';

    const OPTIONS = [
        self::JUNIOR,
        self::MIDLEVEL,
        self::SENIOR
    ];
}
