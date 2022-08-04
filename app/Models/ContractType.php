<?php

namespace App\Models;

abstract class ContractType
{
    const PJ = 'PJ';
    const CLT = 'CLT';
    const INTERNSHIP = 'INTERNSHIP';

    const OPTIONS = [
        self::PJ,
        self::CLT,
        self::INTERNSHIP
    ];
}
