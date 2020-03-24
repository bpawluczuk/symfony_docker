<?php
/**
 * Created by bpawluczuk on mar, 2020
 */

namespace App\Utils\Library\ScValidator;

/**
 * Interface ScValidatorInterface
 * @package App\Utils\Library\ScValidator
 */
interface ScValidatorInterface
{
    public function entityValidate(object $object): array;
}