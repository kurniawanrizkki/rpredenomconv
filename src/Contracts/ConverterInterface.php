<?php

namespace Rpredenomconv\Contracts;

interface ConverterInterface
{
    public function convert(float|int $oldValue): float;
    public function format(float|int $oldValue): string;
    public function dual(float|int $oldValue): string;
}

