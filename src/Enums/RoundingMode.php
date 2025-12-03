<?php

namespace Rpredenomconv\Enums;

enum RoundingMode: string
{
    case HALF_UP = 'half_up';
    case FLOOR = 'floor';
    case CEIL = 'ceil';
}

