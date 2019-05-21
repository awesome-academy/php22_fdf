<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_contains_valid_fillable_properties()
    {
        $m = new Order();
        $this->assertEquals([
            'product_id',
            'user_id',
            'transaction_id',
            'amount',
            'quantity',
            'status',
        ], $m->getFillable());

    }

    public function test_order_relation(){

        $m = new Transaction();
        $relation = $m->order();
        $this->assertInstanceOf(HasMany::class, $relation);
    }

    public function test_status_get(){
        $m = new Transaction();

        $m->setAttribute('status', 0);
        $this->assertEquals(0, $m->getAttributes()['status']);
        $this->assertEquals(@trans('message.status_pending'), $m->getStatus());
        $m->setAttribute('status', 1);
        $this->assertEquals(1, $m->getAttributes()['status']);
        $this->assertEquals(@trans('message.status_done'), $m->getStatus());
        $m->setAttribute('status', 2);
        $this->assertEquals(2, $m->getAttributes()['status']);
        $this->assertEquals(@trans('message.status_reject'), $m->getStatus());

    }
}
