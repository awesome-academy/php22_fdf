<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\AdminOrderController;
use App\Models\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminOrderControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_index_returns_view()
    {
        $controller = new AdminOrderController();
        $view = $controller->index();
        $this->assertEquals('admin.orders.index', $view->getName());
        $this->assertArrayHasKey('transactions', $view->getData());
    }

}
