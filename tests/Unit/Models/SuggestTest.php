<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Suggest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuggestTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_contains_valid_fillable_properties()
    {
        $m = new Suggest();
        $this->assertEquals([
            'category_id',
            'product_name',
            'content',
            'status',
        ], $m->getFillable());
    }

    public function test_suggest_relation(){
        $m = new Suggest();
        $relation = $m->category();
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

    public function test_status_get(){
        $m = new Suggest();

        $m->setAttribute('status', 0);
        $this->assertEquals(0, $m->getAttributes()['status']);
        $this->assertEquals(@trans('message.status_pending'), $m->getStatus());
        $m->setAttribute('status', 1);
        $this->assertEquals(1, $m->getAttributes()['status']);
        $this->assertEquals(@trans('message.status_done'), $m->getStatus());
    }
}
