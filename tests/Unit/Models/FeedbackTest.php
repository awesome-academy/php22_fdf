<?php

namespace Tests\Unit\Models;

use App\Models\FeedBack;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedbackTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_contains_valid_fillable_properties()
    {
        $m = new FeedBack();
        $this->assertEquals([
            'user_id',
            'product_id',
            'content',
        ], $m->getFillable());

    }

    public function test_feedback_relation(){

        $m = new User();
        $relation = $m->feedBack();
        $this->assertInstanceOf(HasMany::class, $relation);

        $m = new Product();
        $relation = $m->feedBack();
        $this->assertInstanceOf(HasMany::class, $relation);
    }
}
