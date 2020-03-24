<?php
/**
 * Created by PhpStorm.
 * User: bpawluczuk
 * Date: 15/11/2018
 * Time: 13:11
 */

namespace App\AbstractModule\Aggregate;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class AbstractAggregate
 * @package App\AbstractModule\Aggregate
 * @author Borys Pawluczuk
 */
abstract class AbstractAggregate
{
    protected $eventPublisher;

    /**
     * @param mixed $eventPublisher
     */
    public function setEventPublisher($eventPublisher)
    {
        $this->eventPublisher = $eventPublisher;
    }

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * @param $service
     * @return object The service
     */
    protected function get($service)
    {
        return $this->container->get($service);
    }

    /**
     * @return Registry
     */
    protected function getDoctrine()
    {
        return $this->get('doctrine');
    }

    /**
     * @param $name
     * @return ObjectRepository
     */
    public function getRepository($name)
    {
        return $this->getDoctrine()->getRepository($name);
    }

    /**
     * @return Request
     */
    protected function getRequest()
    {
        return $this->get('request');
    }

    /**
     * @return ObjectManager|object
     */
    protected function getManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * AbstractAggregate constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $route
     * @param $parameters
     * @param $referenceType
     * @return mixed
     */
    public function generateUrl(string $route, array $parameters = [], int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string
    {
        return $this->container->get('router')->generate($route, $parameters, $referenceType);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getJsonData(Request $request)
    {
        return json_decode($request->getContent(), true);
    }

    /**
     * @param string $url
     * @param array $parameters
     * @param string $method
     * @param array $body
     * @return array
     */
    public function requestAction(string $url, string $method, array $parameters = [], array $body = []): array
    {
        empty($parameters) ? $query = "" : $query = "?";
        foreach ($parameters as $parameter => $value) {
            $query .= $parameter . "=" . $value . "&";
        }
        $query = rtrim($query, "&");

        $client = new Client();
        $request = new \GuzzleHttp\Psr7\Request(
            $method,
            $url . $query,
            [
                'Content-Type' => 'application/json',
                'access-token' => '',
                'Cookie' => 'XDEBUG_SESSION=phpstorm',
            ],
            json_encode($body)
        );

        try {
            $response = $client->send($request);
            $data = json_decode($response->getBody(true), true);
        } catch (ClientErrorResponseException  $exception) {
            $data = [
                'status' => 'error',
                'message' => 'Wystąpił błąd podczas wykonywania akcji: ' . '<br/>' .
                    $exception->getMessage() . '<br/>' .
                    $exception->getResponse()->getBody(),
            ];

            try {
                $data['data'] = json_decode($exception->getResponse()->getBody(), true);
            } catch (\Exception $exception) {
                $data['data'] = [];
            }
        } catch (\Exception $exception) {
            $data = [
                'status' => 'error',
                'message' => 'Błąd serwera: ' . '<br/>' .
                    $exception->getMessage() . '<br/>' .
                    $exception->getResponse()->getBody()
                ,
            ];
        }
        return $data;
    }
}