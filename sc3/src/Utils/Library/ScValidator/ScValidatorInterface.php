<?php
/**
 * Created by bpawluczuk on mar, 2020
 */

namespace App\Utils\Library\ScValidator;

use Symfony\Component\Validator\Constraint;

/**
 * Interface ScValidatorInterface
 * @package App\Utils\Library\ScValidator
 */
interface ScValidatorInterface
{
    public function propertyValidate($property, Constraint $constraint): array;
    public function entityValidate(object $object): array;
    public function arrayValidate(array $fields, array $constraints): array;
}