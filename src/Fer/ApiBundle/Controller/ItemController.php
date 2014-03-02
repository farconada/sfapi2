<?php

namespace Fer\ApiBundle\Controller;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerInterface;
use Fer\ApiBundle\Entity\ItemRepository;
use Fer\ApiBundle\Entity\Item;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @RouteResource("Item")
 */
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

    public function cgetAction()
    {
        $items = $this->repository->findAll();
        $this->response->setContent($this->serializer->serialize($items, 'json'));
        return $this->response;
    }

    /**
     * @ParamConverter("item", converter="fos_rest.request_body")
     */
    public function postAction(Item $item, ConstraintViolationListInterface $validationErrors)
    {

        $this->response->setContent($this->serializer->serialize($item, 'json'));
        return $this->response;
    }
}
