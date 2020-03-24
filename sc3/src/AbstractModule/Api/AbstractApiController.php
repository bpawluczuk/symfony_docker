<?php

namespace App\AbstractModule\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AbstractApiController
 * @package App\AbstractModule\Api
 * @author Borys Pawluczuk
 */
class AbstractApiController extends AbstractController
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @return ValidatorInterface
     */
    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    /**
     * AbstractApiController constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @param null $page_count
     * @return JsonResponse
     */
    protected function getSuccessResponse(array $data, $page_count = null): JsonResponse
    {
        $dataResponse['status'] = 'ok';
        if ($page_count) {
            $dataResponse['page_count'] = $page_count;
        }
        $dataResponse['data'] = $data;

        $response = new JsonResponse($dataResponse);
        $response->headers->set('Cache-Control', 'private, no-cache');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    protected function getBadRequestResponse(string $message = "Bad Request"): JsonResponse
    {
        $dataResponse = [
            'status' => 'error',
            'error_code' => 400,
            'message' => $message,
        ];

        $response = new JsonResponse($dataResponse, 400);
        $response->headers->set('Cache-Control', 'private, no-cache');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    protected function getAccessDeniedResponse(string $message = "Access Denied"): JsonResponse
    {
        $dataResponse = [
            'status' => 'error',
            'error_code' => 401,
            'message' => $message
        ];

        $response = new JsonResponse($dataResponse, 401);
        $response->headers->set('Cache-Control', 'private, no-cache');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    protected function getForbiddenResponse(string $message = 'Forbidden'): JsonResponse
    {
        $dataResponse = [
            'status' => 'error',
            'error_code' => 403,
            'message' => $message
        ];

        $response = new JsonResponse($dataResponse, 403);
        $response->headers->set('Cache-Control', 'private, no-cache');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    protected function getNotFoundResponse(string $message = 'Object not found'): JsonResponse
    {
        $dataResponse = [
            'status' => 'error',
            'error_code' => 404,
            'message' => $message
        ];

        $response = new JsonResponse($dataResponse, 404);
        $response->headers->set('Cache-Control', 'private, no-cache');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * Walidacja na podstawie assercji z klasy Entity obiektu
     * @param object $object
     * @return array
     */
    public function objectValidate(object $object): array
    {
        $result = [];
        $errors = $this->getValidator()->validate($object);

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
     * @param array $constraint
     * @return array
     */
    public function propertyValidate($property, array $constraint): array
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