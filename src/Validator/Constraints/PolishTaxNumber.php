<?php

declare(strict_types=1);

namespace PurpleDot\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Robert Pajer
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class PolishTaxNumber extends Constraint
{
    public const CHECKSUM_FAILED_ERROR = '3b8c637e-56bb-11ed-9b6a-0242ac120002';
    public const TOO_SHORT_ERROR = '3b8c66bc-56bb-11ed-9b6a-0242ac120002';
    public const TOO_LONG_ERROR = '3b8c681a-56bb-11ed-9b6a-0242ac120002';
    public const INVALID_FORMAT_ERROR = '3b8c6950-56bb-11ed-9b6a-0242ac120002';
    public const PREFIX_REQUIRE_ERROR = '65b00047-dd92-467b-8ccc-1e6d0ea7072e';
    public const INVALID_PREFIX_ERROR = 'b8c96d1b-e261-477f-8c85-778410a95861';

    protected const ERROR_NAMES = [
        self::CHECKSUM_FAILED_ERROR => 'CHECKSUM_FAILED_ERROR',
        self::TOO_SHORT_ERROR => 'TOO_SHORT_ERROR',
        self::TOO_LONG_ERROR => 'TOO_LONG_ERROR',
        self::INVALID_FORMAT_ERROR => 'INVALID_FORMAT_ERROR',
        self::PREFIX_REQUIRE_ERROR => 'PREFIX_REQUIRE_ERROR',
        self::INVALID_PREFIX_ERROR => 'INVALID_PREFIX_ERROR',
    ];

    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = [
        self::CHECKSUM_FAILED_ERROR => 'CHECKSUM_FAILED_ERROR',
        self::TOO_SHORT_ERROR => 'TOO_SHORT_ERROR',
        self::TOO_LONG_ERROR => 'TOO_LONG_ERROR',
        self::INVALID_FORMAT_ERROR => 'INVALID_FORMAT_ERROR',
        self::PREFIX_REQUIRE_ERROR => 'PREFIX_REQUIRE_ERROR',
        self::INVALID_PREFIX_ERROR => 'INVALID_PREFIX_ERROR',
    ];

    public $requirePrefix = false;
    public $allowPrefix = true;
    public $prefixRequiredMessage = 'Prefix of the tax number is required';
    public $invalidPrefixMessage = 'Prefix of tax number is invalid';
    public $checkSumFailedMessage = 'The tax number provided is incorrect';
    public $tooShortdMessage = 'The tax number provided is too short';
    public $tooLongdMessage = 'The tax number provided is too long';
    public $invalidFormatMessage = 'The tax number provided contains not permitted characters';

    public function __construct(
        ?bool $requirePrefix = null,
        ?bool $allowPrefix = null,
        ?string $checkSumFailedMessage = null,
        ?string $tooShortdMessage = null,
        ?string $tooLongdMessage = null,
        ?string $invalidFormatMessage = null,
        mixed $options = null,
        array $groups = null,
        mixed $payload = null
    ) {
        parent::__construct($options ?? [], $groups, $payload);

        $this->requirePrefix = $requirePrefix ?? $this->requirePrefix;
        $this->allowPrefix = $allowPrefix ?? $this->allowPrefix;
        $this->checkSumFailedMessage = $checkSumFailedMessage ?? $this->checkSumFailedMessage;
        $this->tooShortdMessage = $tooShortdMessage ?? $this->tooShortdMessage;
        $this->tooLongdMessage = $tooLongdMessage ?? $this->tooLongdMessage;
        $this->invalidFormatMessage = $invalidFormatMessage ?? $this->invalidFormatMessage;
    }
}