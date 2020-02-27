<?php

namespace App\AbstractModule\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AbstractApiController
 * @package App\AbstractModule\Api
 * @author Borys Pawluczuk
 */
class AbstractApiController extends AbstractController
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    protected function getSuccessResponse(array $data): JsonResponse
    {
        $dataResponse['status'] = 'ok';
        $dataResponse['data'] = $data;

        $response = new JsonResponse($dataResponse, 200);
        $response->headers->set('Cache-Control', 'private, no-cache');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    protected function getBadRequestErrorResponse(string $message): JsonResponse
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
    protected function getAccessDeniedErrorResponse(string $message): JsonResponse
    {
        $message = 'Access Denied';

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
    protected function getForbiddenErrorResponse(string $message = 'Forbidden'): JsonResponse
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
    protected function getNotFoundErrorResponse(string $message = 'Object not found'): JsonResponse
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

}