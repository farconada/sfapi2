<?php

namespace Fer\ApiBundle\Controller;

use Fer\AppDomain\Service\ItemServiceInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerInterface;
use Fer\AppDomain\Entity\ItemDTO;
use FOS\RestBundle\Controller\Annotations as RESTRoute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @RESTRoute\RouteResource("Item")
 */
class ItemController
{
    private $itemService;

    private $serializer;

    private $response;

    /**
     * @DI\InjectParams({
     *     "itemService" = @DI\Inject("fer_api.item_service"),
     *     "response"   = @DI\Inject("fer_api.response"),
     *     "serializer" = @DI\Inject("jms_serializer")
     * })
     */
    public function __construct(ItemServiceInterface $itemService, Response $response, SerializerInterface $serializer) {
        $this->itemService = $itemService;
        $this->response   = $response;
        $this->serializer = $serializer;
    }

    public function cgetAction()
    {
        $items = $this->itemService->findAll();
        $this->response->setContent($this->serializer->serialize($items, 'json'));
        return $this->response;
    }

    /**
     * @RESTRoute\Post("/items")
     * @ParamConverter("item", converter="fos_rest.request_body")
     */
    public function postAction(ItemDTO $item)
    {
        $itemEntity = $this->itemService->create($item);
        $this->response->setContent($this->serializer->serialize($itemEntity, 'json'));
        return $this->response;
    }

    /**
     * @ParamConverter("item", converter="fos_rest.request_body")
     */
    public function putAction(ItemDTO $item)
    {
        $itemEntity = $this->itemService->update($item);
        $this->response->setContent($this->serializer->serialize($itemEntity, 'json'));
        return $this->response;
    }

    public function deleteAction($itemId) {
        $this->itemService->delete($itemId);
        $this->response->setContent($this->serializer->serialize(array('msg' => 'deleted'), 'json'));
        return $this->response;
    }

    public function getAction($itemId) {
        $itemEntity = $this->itemService->find($itemId);
        $this->response->setContent($this->serializer->serialize($itemEntity, 'json'));
        return $this->response;
    }
}
