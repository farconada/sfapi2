<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/14
 * Time: 15:52
 */

namespace Fer\AppDomain\Service;


use Doctrine\ORM\Persisters\PersisterException;
use Fer\AppDomain\Repository\ItemRepositoryInterface;
use Fer\AppDomain\Entity\ItemDTO;
use Fer\AppDomain\Entity\Item;

class ItemService implements ItemServiceInterface
{

    private $repository;

    public function __construct(ItemRepositoryInterface $itemRepository) {
        $this->repository = $itemRepository;
    }

    public function findAll() {
        return $this->repository->findAll();
    }
    public function create(ItemDTO $itemDTO) {
        $itemEntity = new Item($itemDTO->name);
        $itemEntity->setDescription($itemDTO->description);
        $this->repository->save($itemEntity);
        return $itemEntity;
    }

    public function update(ItemDTO $itemDTO) {
        $itemEntity = $this->repository->find($itemDTO->id);

        if ($itemEntity == null){
            throw new PersisterException();
        }

        if (!$itemDTO->name == null) {
            $itemEntity->setName($itemDTO->name);
        }

        if (!$itemDTO->description == null) {
            $itemEntity->setDescription($itemDTO->description);
        }

        $this->repository->save($itemEntity);

        return $itemEntity;
    }

    public function delete($itemId){
        $itemEntity = $this->repository->find($itemId);
        $this->repository->delete($itemEntity);
    }

    public function find($itemId) {
        return $this->repository->find($itemId);
    }
} 