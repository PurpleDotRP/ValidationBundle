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
class PolishIdCardNumber extends Constraint
{
    public const CHECKSUM_FAILED_ERROR = 'eb7c8688-721d-11ed-a1eb-0242ac120002';
    public const TOO_SHORT_ERROR = 'eb7c8a48-721d-11ed-a1eb-0242ac120002';
    public const TOO_LONG_ERROR = 'eb7c8bd8-721d-11ed-a1eb-0242ac120002';
    public const INVALID_FORMAT_ERROR = 'eb7c8d40-721d-11ed-a1eb-0242ac120002';

    protected const ERROR_NAMES = [
        self::CHECKSUM_FAILED_ERROR => 'CHECKSUM_FAILED_ERROR',
        self::TOO_SHORT_ERROR => 'TOO_SHORT_ERROR',
        self::TOO_LONG_ERROR => 'TOO_LONG_ERROR',
        self::INVALID_FORMAT_ERROR => 'INVALID_FORMAT_ERROR',
    ];

    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = [
        self::CHECKSUM_FAILED_ERROR => 'CHECKSUM_FAILED_ERROR',
        self::TOO_SHORT_ERROR => 'TOO_SHORT_ERROR',
        self::TOO_LONG_ERROR => 'TOO_LONG_ERROR',
        self::INVALID_FORMAT_ERROR => 'INVALID_FORMAT_ERROR',
    ];

    public $checkSumFailedMessage = 'The ID card number provided is incorrect';
    public $tooShortdMessage = 'The ID card number provided is too short';
    public $tooLongdMessage = 'The ID card number provided is too long';
    public $invalidFormatMessage = 'The ID card number provided contains not permitted characters';

    public function __construct(
        ?string $checkSumFailedMessage = null,
        ?string $tooShortdMessage = null,
        ?string $tooLongdMessage = null,
        ?string $invalidFormatMessage = null,
        mixed $options = null,
        array $groups = null,
        mixed $payload = null
    ) {
        parent::__construct($options ?? [], $groups, $payload);

        $this->checkSumFailedMessage = $checkSumFailedMessage ?? $this->checkSumFailedMessage;
        $this->tooShortdMessage = $tooShortdMessage ?? $this->tooShortdMessage;
        $this->tooLongdMessage = $tooLongdMessage ?? $this->tooLongdMessage;
        $this->invalidFormatMessage = $invalidFormatMessage ?? $this->invalidFormatMessage;
    }
}