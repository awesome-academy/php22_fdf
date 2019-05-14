<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id, $quantity){
        $cart = [
            'quantity' => config('setting.default_value_0'),
            'price' => $item->newPrice(),
            'item' => $item
        ];

        if ( $this->items && array_key_exists($id, $this->items)) {
            $cart = $this->items[$id];
        }

        $cart['quantity'] += $quantity;
        $cart['price'] = $item->newPrice() * $cart['quantity'];

        $this->items[$id] = $cart;
        $this->totalQty += $quantity;
        $this->totalPrice += $item->newPrice()* $quantity;
    }

    public function removeItem($id){
        $this->totalQty -= $this->items[$id]['quantity'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
