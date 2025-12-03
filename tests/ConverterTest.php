<?php

use Rpredenomconv\Services\RedenominationConverter;

it('can convert rupiah correctly', function () {
    $config = require __DIR__.'/../config/rpredenomconv.php';
    $service = new RedenominationConverter($config);

    expect($service->convert(1000))->toBe(1.0);
    expect($service->convert(2500))->toBe(3.0);
});

it('can show dual display', function () {
    $config = require __DIR__.'/../config/rpredenomconv.php';
    $service = new RedenominationConverter($config);

    $result = $service->dual(1500000);

    expect($result)->toContain('Rp 1.500.000');
    expect($result)->toContain('Rp 1.500');
});

