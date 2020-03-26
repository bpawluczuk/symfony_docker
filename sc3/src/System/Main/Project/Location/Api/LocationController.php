<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\System\Main\Project\Location\Api;

use App\System\BaseClass\Api\AbstractApiController;
use App\Utils\Library\ScPaginate\ScPaginate;
use App\System\Main\Project\Location\CQRS\LocationCommand;
use App\System\Main\Project\Location\CQRS\LocationQuery;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

/**
 * Class LocationController
 * @package App\System\Main\Project\Location\Api
 * @author Borys Pawluczuk
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
     * )
     * @SWG\Parameter(
     *     name="page",
     *     in="query",
     *     type="number",
     *     description="page number"
     * )
     * @SWG\Parameter(
     *     name="limit",
     *     in="query",
     *     type="number",
     *     description="results limit per page"
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
     *          description="Location object in json format",
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
        $dataResponse = [];

        try {
            $cmd = new LocationCommand($this->container);
            $entity = $cmd->entityFactory($data);
            $dataResponse['validation_messages'] = $this->getValidator()->entityValidate($entity);
            if(empty($dataResponse['validation_messages'])){
                $dataResponse['valid'] = true;
                $cmd->persist($entity);
                $cmd->flusch($entity);
            }else{
                $dataResponse['valid'] = false;
            }
            return $this->getSuccessResponse($dataResponse);

        } catch (\Exception $e) {
            return $this->getBadRequestResponse($e->getMessage());
        }
    }
}