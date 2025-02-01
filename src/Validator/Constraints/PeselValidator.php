<?php

declare(strict_types=1);

namespace PurpleDot\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

/**
 * @author Robert Pajer
 */
class PeselValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Pesel) {
            throw new UnexpectedTypeException($constraint, Pesel::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (!preg_match('/^\d+$/', $value)) {
            $this->context->buildViolation($constraint->invalidFormatMessage)
                ->setCode(Pesel::INVALID_FORMAT_ERROR)
                ->addViolation();

            return;
        }

        if (strlen($value) < 11) {
            $this->context->buildViolation($constraint->tooShortMessage)
                ->setCode(Pesel::TOO_SHORT_ERROR)
                ->addViolation();

            return;
        }

        if (strlen($value) > 11) {
            $this->context->buildViolation($constraint->tooLongMessage)
                ->setCode(Pesel::TOO_LONG_ERROR)
                ->addViolation();

            return;
        }

        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $chars = str_split($value);

        $sum = array_sum(
            array_map(
                function($weight, $digit) {
                    $stepValue = $weight * $digit;

                    if ($stepValue >= 10) {
                        return $stepValue % 10;
                    }

                    return $stepValue;
                },
                $weights,
                array_slice($chars, 0, 10)
            )
        );

        if ((10 - ($sum % 10)) % 10 != $chars[10]) {
            $this->context->buildViolation($constraint->checkSumFailedMessage)
                ->setCode(Pesel::CHECKSUM_FAILED_ERROR)
                ->addViolation();
        }
    }
}