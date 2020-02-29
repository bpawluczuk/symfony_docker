<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\LocalizationModule\Api;

use App\AbstractModule\Api\AbstractApiController;
use App\AbstractModule\Infrastructure\Util\Paginate;
use App\LocalizationModule\Aggregate\LocalizationCommand;
use App\LocalizationModule\Aggregate\LocalizationQuery;
use App\LocalizationModule\Domain\Entity\Localization;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
                "created_at" => $item->getCreatedAt()->getTimestamp(),
                "updated_at" => $item->getUpdatedAt()->getTimestamp(),
            ];
        }

        $paginate = new Paginate(
            $result,
            $request->query->get('page'),
            $request->query->get('limit')
        );

        return $this->getSuccessResponse(
            $paginate->getArrayResult(),
            $paginate->getPageCount()
        );
    }

    /**
     * @Route("/add", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        $name = $request->get('name');

        if (empty($name)) {
            return $this->getBadRequestResponse("Field name is required");
        }

        try {
            $command = new LocalizationCommand($this->container);
            $command->create($name);
        } catch (\Exception $e) {
            return $this->getBadRequestResponse($e->getMessage());
        }

        return $this->getSuccessResponse([]);
    }
}