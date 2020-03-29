<?php

namespace App\System\BaseClass\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
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
    const HTTP_MSG_BAD_REQUEST = 'Bad Request';
    const HTTP_ACCESS_DENIED = 401;
    const HTTP_MSG_ACCESS_DENIED = 'Access Denied';
    const HTTP_FORBIDDEN = 403;
    const HTTP_MSG_FORBIDDEN = 'Forbidden';
    const HTTP_NOT_FOUND = 404;
    const HTTP_MSG_NOT_FOUND = 'Object not found';
    const HTTP_UNPROCESSABLE_ENTITY = 422;


    /**
     * @var int $statusCode
     */
    protected $statusCode = self::HTTP_OK;

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return AbstractApiController
     */
    public function setStatusCode(int $statusCode): AbstractApiController
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, $headers = [])
    {
        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $errors
     * @param array $headers
     * @return JsonResponse
     */
    public function responseWithErrors($errors, $headers = [])
    {
        $data = [
            'errors' => $errors,
        ];

        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function responseUnauthorized($message = self::HTTP_MSG_ACCESS_DENIED)
    {
        return $this->setStatusCode(self::HTTP_ACCESS_DENIED)->responseWithErrors($message);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function responseValidationError($data)
    {
        $dataResponse['valid'] = false;
        $dataResponse['data'] = $data;
        return $this->setStatusCode(self::HTTP_UNPROCESSABLE_ENTITY)->response($dataResponse);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function responseValidationOk($data)
    {
        $dataResponse['valid'] = true;
        $dataResponse['data'] = $data;
        return $this->setStatusCode(self::HTTP_OK)->response($dataResponse);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function responseBadRequest($message = self::HTTP_MSG_BAD_REQUEST)
    {
        return $this->setStatusCode(self::HTTP_BAD_REQUEST)->responseWithErrors($message);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function responseNotFound($message = self::HTTP_MSG_NOT_FOUND)
    {
        return $this->setStatusCode(self::HTTP_NOT_FOUND)->responseWithErrors($message);
    }

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
     * @var EventDispatcherInterface $dispatcher
     */
    protected $dispatcher;

    /**
     * @required
     * @param EventDispatcherInterface $dispatcher
     */
    public function setDispatcher(EventDispatcherInterface $dispatcher): void
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getDispatcher(): EventDispatcherInterface
    {
        return $this->dispatcher;
    }

}