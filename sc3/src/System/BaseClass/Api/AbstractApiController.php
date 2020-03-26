<?php

namespace App\System\BaseClass\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Utils\Library\ScValidator\ScValidatorInterface;

/**
 * Class AbstractApiController
 * @package App\System\BaseClass\Api
 * @author Borys Pawluczuk
 */
class AbstractApiController extends AbstractController
{
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;

    const HTTP_BAD_REQUEST = 400;
    const HTTP_ACCESS_DENIED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;

    /**
     * @var ScValidatorInterface
     */
    private $validator;

    /**
     * @return ScValidatorInterface
     */
    public function getValidator(): ScValidatorInterface
    {
        return $this->validator;
    }

    /**
     * @required
     * @param ScValidatorInterface $validator
     */
    public function setValidator(ScValidatorInterface $validator): void
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
        empty($page_count) ?: $dataResponse['page_count'] = $page_count;
        $dataResponse['data'] = $data;

        $response = new JsonResponse($dataResponse, self::HTTP_OK);
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
            'error_code' => self::HTTP_BAD_REQUEST,
            'message' => $message,
        ];

        $response = new JsonResponse($dataResponse, self::HTTP_BAD_REQUEST);
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
            'error_code' => self::HTTP_ACCESS_DENIED,
            'message' => $message
        ];

        $response = new JsonResponse($dataResponse, self::HTTP_ACCESS_DENIED);
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
            'error_code' => self::HTTP_FORBIDDEN,
            'message' => $message
        ];

        $response = new JsonResponse($dataResponse, self::HTTP_FORBIDDEN);
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
            'error_code' => self::HTTP_NOT_FOUND,
            'message' => $message
        ];

        $response = new JsonResponse($dataResponse, self::HTTP_NOT_FOUND);
        $response->headers->set('Cache-Control', 'private, no-cache');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @param array $data
     * @param array $parameters
     * @return JsonResponse
     */
    protected function getCustomResponse(array $data, array $parameters): JsonResponse
    {
        $dataResponse['status'] = 'ok';

        empty($parameters['status']) ?: $dataResponse['status'] = $parameters['status'];
        empty($parameters['page_count']) ?: $dataResponse['page_count'] = $parameters['page_count'];
        empty($parameters['message']) ?: $dataResponse['message'] = $parameters['message'];
        empty($parameters['http_status']) ? $http_status = $parameters['http_status'] : $http_status = self::HTTP_OK;

        $dataResponse['data'] = $data;

        $response = new JsonResponse($dataResponse, $http_status);
        $response->headers->set('Cache-Control', 'private, no-cache');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}