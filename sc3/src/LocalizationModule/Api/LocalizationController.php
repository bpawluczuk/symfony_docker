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
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

/**
 * Class LocalizationController
 * @package App\LocalizationModule\Api
 * @Route("/api/localization")
 */
class LocalizationController extends AbstractApiController
{
    /**
     * @Route("/list", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns the Localizations",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref="#definitions/Reward")
     *     )
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function getList(Request $request)
    {
        $query = new LocalizationQuery($this->container);

        $paginate = new Paginate(
            $query->getList([]),
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