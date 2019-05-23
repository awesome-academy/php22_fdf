<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\FeedBack;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function  test_contains_valid_fillable_properties()
    {
        $m = new Product();
        $this->assertEquals([
            'category_id',
            'name',
            'description',
            'price',
            'discount',
            'slug',
            'quantity',
            'rating',
        ], $m->getFillable());

    }

    public function test_product_relation(){

        $m = new FeedBack();
        $relation = $m->product();
        $this->assertInstanceOf(BelongsTo::class, $relation);

        $m = new Image();
        $relation = $m->product();
        $this->assertInstanceOf(BelongsTo::class, $relation);

        $m = new Category();
        $relation = $m->products();
        $this->assertInstanceOf(HasMany::class, $relation);
    }

    public function test_new_price(){
        $m = new Product();
        $m->setAttribute('price', 10000);
        $m->setAttribute('discount', 5);
        $this->assertEquals(5000, $m->newPrice());
    }
}
