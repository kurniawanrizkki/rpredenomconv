<?php

namespace Rpredenomconv\Helpers;

class FormatHelper
{
    public static function rupiah(float|int $value): string
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}

