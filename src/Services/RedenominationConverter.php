<?php

namespace Rpredenomconv\Services;

use Rpredenomconv\Contracts\ConverterInterface;
use Rpredenomconv\Enums\RoundingMode;
use Rpredenomconv\Helpers\FormatHelper;

class RedenominationConverter implements ConverterInterface
{
    protected int $scale;
    protected RoundingMode $rounding;
    protected bool $dual;
    protected string $prefix;
    protected string $separator;

    public function __construct(array $config)
    {
        $this->scale = $config['scale'];
        $this->rounding = RoundingMode::from($config['rounding']);
        $this->dual = $config['dual_display'];
        $this->prefix = $config['prefix'];
        $this->separator = $config['dual_separator'];
    }

    public function convert(float|int $oldValue): float
    {
        $value = $oldValue / $this->scale;

        return match ($this->rounding) {
            RoundingMode::HALF_UP => round($value, 0, PHP_ROUND_HALF_UP),
            RoundingMode::FLOOR => floor($value),
            RoundingMode::CEIL => ceil($value),
        };
    }

    public function format(float|int $oldValue): string
    {
        $new = $this->convert($oldValue);
        return $this->prefix . ' ' . number_format($new, 0, ',', '.');
    }

    public function dual(float|int $oldValue): string
    {
        if (!$this->dual) {
            return $this->format($oldValue);
        }

        $old = $this->prefix . ' ' . number_format($oldValue, 0, ',', '.');
        $new = $this->format($oldValue);

        return "{$old} {$this->separator} {$new}";
    }
}

