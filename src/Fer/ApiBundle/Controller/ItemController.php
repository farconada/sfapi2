<?php

namespace Fer\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerInterface;
use Fer\ApiBundle\Entity\ItemRepository;

class ItemController
{
    private $repository;

    private $templating;

    private $response;

    /**
     * @DI\InjectParams({
     *     "repository" = @DI\Inject("fer_api.item_repository"),
     *     "templating" = @DI\Inject("templating"),
     *     "response"   = @DI\Inject("fer_api.response"),
     *     "serializer" = @DI\Inject("jms_serializer")
     * })
     */
    public function __construct(ItemRepository $repository, EngineInterface $templating, Response $response, SerializerInterface $serializer) {
        $this->repository = $repository;
        $this->templating = $templating;
        $this->response   = $response;
        $this->serializer = $serializer;
    }
    public function listAction()
    {
        $items = $this->repository->findAll();
        $this->response->setContent($this->serializer->serialize($items, 'json'));
        return $this->response;
    }
}
