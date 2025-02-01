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
class PolishIdCardNumberValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof PolishIdCardNumber) {
            throw new UnexpectedTypeException($constraint, PolishIdCardNumber::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }
        
        if (strlen($value) < 9) {
            $this->context->buildViolation($constraint->tooShortdMessage)
                ->setCode(PolishIdCardNumber::TOO_SHORT_ERROR)
                ->addViolation();

            return;
        }

        if (strlen($value) > 9) {
            $this->context->buildViolation($constraint->tooLongdMessage)
                ->setCode(PolishIdCardNumber::TOO_LONG_ERROR)
                ->addViolation();

            return;
        }

        if (!preg_match('/^[a-zA-Z]{3}[0-9]{6}/', $value)) {
            $this->context->buildViolation($constraint->invalidFormatMessage)
                ->setCode(PolishIdCardNumber::INVALID_FORMAT_ERROR)
                ->addViolation();

            return;
        }

        $value = strtoupper($value);

        $charValues = [
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9,
            'A' => 10,
            'B' => 11,
            'C' => 12,
            'D' => 13,
            'E' => 14,
            'F' => 15,
            'G' => 16,
            'H' => 17,
            'I' => 18,
            'J' => 19,
            'K' => 20,
            'L' => 21,
            'M' => 22,
            'N' => 23,
            'O' => 24,
            'P' => 25,
            'Q' => 26,
            'R' => 27,
            'S' => 28,
            'T' => 29,
            'U' => 30,
            'V' => 31,
            'W' => 32,
            'X' => 33,
            'Y' => 34,
            'Z' => 35,
        ];
        $weights = [7,3,1,0,7,3,1,7,3];
        $sum = 0;

        for ($i = 0; $i < 9; $i++) {
            $sum += $charValues[$value[$i]] * $weights[$i];
        }

        if (($sum % 10) != $value[3]) {
            $this->context->buildViolation($constraint->checkSumFailedMessage)
                ->setCode(PolishIdCardNumber::CHECKSUM_FAILED_ERROR)
                ->addViolation();
        }
    }
}
