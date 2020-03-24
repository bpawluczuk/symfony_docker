<?php
/**
 * Created by bpawluczuk on mar, 2020
 */

namespace App\Utils\Library\ScValidator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ScValidator
 * @package App\Utils\Library\ScValidator
 * @author Borys Pawluczuk
 */
class ScValidator implements ScValidatorInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * Validation constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @required
     * @param ValidatorInterface $validator
     */
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    /**
     * @return ValidatorInterface
     */
    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    /**
     * Walidacja na podstawie assercji z klasy Entity obiektu
     * @param object $entity
     * @return array
     */
    public function entityValidate(object $entity): array
    {
        $result = [];
        $errors = $this->getValidator()->validate($entity);

        /**
         * @var ConstraintViolation $error
         */
        foreach ($errors as $error) {
            $result[] = [
                'property' => $error->getPropertyPath(),
                'message' => $error->getMessage()
            ];
        }

        return $result;
    }

    /**
     * Walidacja na podstawie danych w tablicy pol oraz danych w tablicy assercji
     * @param array $fields
     * @param array $constraints
     * @return array
     */
    public function arrayValidate(array $fields, array $constraints): array
    {
        $result = [];

        $errors = $this->getValidator()->validate($fields, $constraints);

        /**
         * @var ConstraintViolation $error
         */
        foreach ($errors as $error) {
            $result[] = [
                'property' => $error->getPropertyPath(),
                'message' => $error->getMessage()
            ];
        }

        return $result;
    }

    /**
     * Walidacja na podstawie danych w tablicy pol oraz danych w tablicy assercji
     * @param $property
     * @param Constraint $constraint
     * @return array
     */
    public function propertyValidate($property, Constraint $constraint): array
    {
        $result = [];

        $errors = $this->getValidator()->validate($property, $constraint);

        /**
         * @var ConstraintViolation $error
         */
        foreach ($errors as $error) {
            $result[] = [
                'property' => $error->getPropertyPath(),
                'message' => $error->getMessage()
            ];
        }

        return $result;
    }
}