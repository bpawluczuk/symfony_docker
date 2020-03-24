<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\LocationModule\Api;

use App\AbstractModule\Api\AbstractApiController;
use App\Utils\Library\ScPaginate\ScPaginate;
use App\LocationModule\Aggregate\LocationCommand;
use App\LocationModule\Aggregate\LocationQuery;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

/**
 * Class LocationController
 * @package App\LocationModule\Api
 * @Route("/api/location")
 */
class LocationController extends AbstractApiController
{
    /**
     * @Route("/list", methods={"GET"})
     * @SWG\Tag(name="WebApi Location")
     * @SWG\Response(
     *     response=200,
     *     description="Returns the Locations",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref="#definitions/Reward")
     *     )
     * )
     * @SWG\Parameter(
     *     name="page",
     *     in="query",
     *     type="number",
     *     description="Strona"
     * )
     * @SWG\Parameter(
     *     name="limit",
     *     in="query",
     *     type="number",
     *     description="Limit"
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function getList(Request $request)
    {
        $query = new LocationQuery($this->container);

        $paginate = new ScPaginate(
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
     * @SWG\Tag(name="WebApi Location")
     * @SWG\Response(
     *     response=200,
     *     description="Add the Locations",
     * )
     * @SWG\Post(
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Location",
     *          in="body",
     *          description="Obiekt lokalizacji podany w formacie json",
     *          required=true,
     *          type="json",
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="name", type="string", example="Auchan Bydgoszcz"),
     *          )
     *     )
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $result = [];

        try {
            $cmd = new LocationCommand($this->container);
            $entity = $cmd->entityFactory($data);
            $result['validation_messages'] = $this->getValidator()->entityValidate($entity);
            if(empty($result['validation_messages'])){
                $cmd->persist($entity);
                $cmd->flusch($entity);
            }
            return $this->getSuccessResponse($result);

        } catch (\Exception $e) {
            return $this->getBadRequestResponse($e->getMessage());
        }
    }
}