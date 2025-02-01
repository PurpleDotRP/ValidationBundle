# Symfony Validation Bundle

Additional validators set for Symfony.

## Installation

From the command line run

```
$ composer require purpledot/validation-bundle
```

## Validators

### PolishIdCardNumber

Checks if the value is a valid Polish ID number.

Example usage

```php
use PurpleDot\ValidationBundle\Validator\Constraints as PurpleDotAssert;

// ...

#[PurpleDotAssert\PolishIdCardNumber]
private ?string $idCardNUmber = null;
```

### PolishMobilePhone

Checks if the value is a valid Polish mobile phone number.

Example usage

```php
use PurpleDot\ValidationBundle\Validator\Constraints as PurpleDotAssert;

// ...

#[PurpleDotAssert\PolishMobilePhone]
private ?string $phoneNumber;
```

### PolishTaxNumber

Checks if the value is a valid Polish tax number (NIP).

| Parameter | Type | Default | Description |
|---|---|---------|---| 
| requirePrefix | bool | false   | Enable/disable tax number prefix requirement |
| allowPrefix | bool | true    | Enable/Disable ability to provide a tax number prefix |

Example usage

```php
use PurpleDot\ValidationBundle\Validator\Constraints as PurpleDotAssert;

// ...

#[PurpleDotAssert\PolishTaxNumber]
private ?string $taxNumber;

$this->taxNumber = 'PL7746249830' // valid
$this->taxNumber = '7746249830' // valid 
```

Require tax number prefix

```php
use PurpleDot\ValidationBundle\Validator\Constraints as PurpleDotAssert;

// ...

#[PurpleDotAssert\PolishTaxNumber(requirePrefix: true)]
private ?string $taxNumber;

$this->taxNumber = 'PL7746249830' // valid
$this->taxNumber = '7746249830' // invalid 
```

Disallow tax number prefix

```php
use PurpleDot\ValidationBundle\Validator\Constraints as PurpleDotAssert;

// ...

#[PurpleDotAssert\PolishTaxNumber(allowPrefix: false)]
private ?string $taxNumber;

$this->taxNumber = '7746249830' // valid 
$this->taxNumber = 'PL7746249830' // invalid
```
### Pesel

Checks if the value is a valid PESEL number.

Example usage

```php
use PurpleDot\ValidationBundle\Validator\Constraints as PurpleDotAssert;

// ...

#[PurpleDotAssert\Pesel]
private ?string $pesel = null;
```