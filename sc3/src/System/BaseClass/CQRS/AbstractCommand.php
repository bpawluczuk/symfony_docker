<?php
/**
 * Created by PhpStorm.
 * User: bpawluczuk
 * Date: 15/11/2018
 * Time: 13:11
 */

namespace App\System\BaseClass\CQRS;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AbstractCqrsManager
 * @package App\System\BaseClass\CQRS
 * @author Borys Pawluczuk
 */
abstract class AbstractCommand
{
    /**
     * @var EventDispatcherInterface $dispatcher
     */
    protected $dispatcher;

    /**
     * @return EventDispatcherInterface
     */
    public function getDispatcher(): EventDispatcherInterface
    {
        return $this->dispatcher;
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
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(ContainerInterface $container, EventDispatcherInterface $dispatcher)
    {
        $this->container = $container;
        $this->dispatcher = $dispatcher;
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
     * @param object $object
     */
    public function persist(object $object)
    {
        $this->getManager()->persist($object);
    }

    /**
     * @param object $object
     */
    public function flusch(object $object)
    {
        $this->getManager()->flush();
    }
}