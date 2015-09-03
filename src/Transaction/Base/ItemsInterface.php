<?php

namespace Ixopay\Client\Transaction\Base;
use Ixopay\Client\Data\Item;

/**
 * Interface ItemsInterface
 *
 * @package Ixopay\Client\Transaction\Base
 */
interface ItemsInterface {

    /**
     * @param Item[] $items
     * @return void
     */
    public function setItems($items);

    /**
     * @return Item[]
     */
    public function getItems();

    /**
     * @param Item $item
     * @return void
     */
    public function addItem($item);

}