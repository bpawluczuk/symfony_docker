<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\LocalizationModule\Api;

use App\AbstractModule\Api\AbstractApiController;
use App\LocalizationModule\Aggregate\LocalizationQuery;
use App\LocalizationModule\Domain\Entity\Localization;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class LocalizationController
 * @package App\LocalizationModule\Api
 * @Route("/localization")
 */
class LocalizationController extends AbstractApiController
{
    /**
     * @Route("/list", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getList(Request $request)
    {
        $result = [];
        $query = new LocalizationQuery($this->container);

        /**
         * @var Localization $item
         */
        foreach ($query->getList() as $item) {
            $result[] = [
                "name" => $item->getName(),
                "createAt" => $item->getCreatedAt()->getTimestamp(),
                "updateAt" => $item->getUpdatedAt()->getTimestamp(),
            ];
        }

        return $this->getSuccessResponse($result);
    }

    /**
     * @Route("/add", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        $result = [];

        $response = new JsonResponse($result);
        $response->headers->set('Cache-Control', 'private, no-cache');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}