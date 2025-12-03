# rpredenomconv

rpredenomconv is an open-source Laravel package for handling Rupiah redenomination (1000:1).  
This library is designed to assist UMKM and Fintech systems in performing safe currency conversion, dual display, and automatic database migration during the redenomination transition period.

---

## Features

- Rupiah old-to-new conversion (1000:1)
- Currency formatting
- Dual currency display (old and new value)
- Configurable rounding modes
- Laravel Facade support
- Automatic database redenomination via Artisan command
- Dry-run migration mode
- Automatic backup into `_old` columns
- Transaction-safe migration process
- Suitable for UMKM, Fintech, POS, ERP, and Accounting Systems

---

## Requirements

- PHP 8.1 or higher  
- Laravel 9.x, 10.x, or 11.x  
- MySQL / PostgreSQL supported

---

## Installation

### Using Composer

```bash
composer require kurniawanrizki/rpredenomconv
````

If you are using a local path repository:

```bash
composer config repositories.rpredenomconv path ../rpredenomconv
composer require kurniawanrizki/rpredenomconv:@dev
```

---

## Configuration

### Publish Configuration File

```bash
php artisan vendor:publish --tag=rpredenomconv-config
```

File location:

```txt
config/rpredenomconv.php
```

### Available Configuration Options

```php
return [
    'scale' => 1000,
    'rounding' => 'half_up',  // half_up | floor | ceil
    'dual_display' => true,
    'dual_separator' => '≈',
    'prefix' => 'Rp',
];
```

---

## Basic Usage

### Using the Facade

```php
use Rpredenomconv\Facades\Redenom;

$value = 150000;

Redenom::convert($value); // 150
Redenom::format($value);  // Rp 150
Redenom::dual($value);    // Rp 150.000 ≈ Rp 150
```

---

### Using the Service Container

```php
$value = 150000;

$service = app('rpredenomconv');

$service->convert($value);
$service->format($value);
$service->dual($value);
```

---

## Rounding Modes

The rounding behavior can be configured using the `rounding` option.

| Mode    | Description                    |
| ------- | ------------------------------ |
| half_up | Standard mathematical rounding |
| floor   | Always round down              |
| ceil    | Always round up                |

Example:

```php
// config/rpredenomconv.php
'rounding' => 'floor';
```

---

## Dual Display Output Example

```php
Redenom::dual(1250000);
```

Output:

```txt
Rp 1.250.000 ≈ Rp 1.250
```

---

## Automatic Database Migration

This package provides an Artisan command to automatically convert numeric columns inside your database.

### Dry Run (Simulation)

Runs migration without changing any data.

```bash
php artisan rpredenom:migrate --dry-run
```

---

### Live Migration

Performs actual conversion.

```bash
php artisan rpredenom:migrate
```

---

### Migrate Specific Tables

```bash
php artisan rpredenom:migrate --tables=orders --tables=transactions
```

---

## Migration Behavior

For every numeric column found:

1. A new backup column will be created with `_old` suffix
2. The old value will be copied into the `_old` column
3. The original column value will be divided by 1000
4. The operation is executed inside a database transaction
5. Dry-run mode skips data modification

Example:

```txt
orders.total     -> orders.total_old
orders.total / 1000 -> orders.total
```

---

## Important Safety Notes

* Always perform a database backup before running live migration.
* Always run dry-run first.
* Test on staging environment before production use.
* Review all affected columns manually after migration.

---

## Testing

To run package tests:

```bash
./vendor/bin/phpunit
```

---

## Directory Structure

```txt
src/
├── Console/Commands/
│   └── RedenominateDatabaseCommand.php
├── Contracts/
├── Enums/
├── Facades/
├── Helpers/
├── Services/
└── RpredenomconvServiceProvider.php
config/
└── rpredenomconv.php
tests/
```

---

## Example Use Cases

* POS systems for UMKM
* Fintech and digital payment systems
* E-commerce pricing systems
* Accounting and ERP software
* Payroll systems
* Tax reporting systems

---

## Roadmap

* Rollback command for restoring values from `_old`
* CSV export of migration results
* Decimal precision support for accounting systems
* REST API support
* Multi-currency support
* CI/CD integration using GitHub Actions

---

## Contributing

Contributions are welcome through pull requests.
Please ensure that all changes include proper tests and documentation.

---

## License

MIT License
Copyright © 2025
Kurniawan Rizki
