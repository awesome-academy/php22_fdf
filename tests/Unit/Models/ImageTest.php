<?php

namespace Tests\Unit\Models;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_contains_valid_fillable_properties()
    {
        $m = new Image();
        $this->assertEquals([
            'url',
            'product_id',
        ], $m->getFillable());

    }

    public function test_image_relation(){

        $m = new Product();
        $relation = $m->images();
        $this->assertInstanceOf(HasMany::class, $relation);
    }
}
