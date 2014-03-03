<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/14
 * Time: 20:53
 */
namespace Fer\AppDomain\Service;

use Fer\AppDomain\Entity\ItemDTO;

interface ItemServiceInterface
{
    public function find($itemId);

    public function create(ItemDTO $itemDTO);

    public function delete($itemId);

    public function findAll();

    public function update(ItemDTO $itemDTO);
}