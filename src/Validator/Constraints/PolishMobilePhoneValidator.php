<?php

namespace PurpleDot\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

/**
 * @author Robert Pajer
 */
class PolishMobilePhoneValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof PolishMobilePhone) {
            throw new UnexpectedTypeException($constraint, PolishMobilePhone::class);
        }

        if (mb_strlen($value, 'UTF-8') !== 9 || null === $value || '' === $value) {
            $this->context->buildViolation($constraint->lengthMessage)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(PolishMobilePhone::LENGTH_ERROR)
                ->addViolation();
        }

        if (!\is_scalar($value) && !is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        $value = (string) $value;

        $phoneNumberPattern = '/^(2111|45[0-1]\d|450[0-4]|451[0-6]|452[0-9]|453[0-9]|454[0-9]|455[4-5]|456[4-7]|459[0-6]|459[8-9]|50[0-9]{2}|51[0-9]{2}|53[0-9]{2}|57[0-9]{2}|59[0-7]|59[8-9]|60[0-9]{2}|66[0-9]{2}|69[0-9]{2}|72[0-9]{2}|728[0-9]|73[0-9]{2}|78[0-9]{2}|79[0-9]{2}|88[0-9]{2})/D';

        if (!preg_match($phoneNumberPattern, $value)) {
            $this->context->buildViolation($constraint->invalidNumberMessage)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(PolishMobilePhone::INVALID_NUMBER_ERROR)
                ->addViolation();
        }
    }
}
