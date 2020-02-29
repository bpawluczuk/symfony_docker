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

}