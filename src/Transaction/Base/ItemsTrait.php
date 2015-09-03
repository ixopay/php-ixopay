<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\Item;

/**
 * Class ItemsTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait ItemsTrait {

    /** @var Item[]  */
    protected $items = array();

    /**
     * @param Item[] $items
     *
     * @return void
     */
    public function setItems($items) {
        $this->items = $items;
    }

    /**
     * @return Item[]
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * @param Item $item
     *
     * @return void
     */
    public function addItem($item) {
        $this->items[] = $item;
    }
}