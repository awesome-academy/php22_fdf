<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_contains_valid_fillable_properties()
    {
        $m = new Category();
        $this->assertEquals([
            'name',
            'description',
            'parent_id',
            'slug',
        ], $m->getFillable());

    }

    public function test_category_relation(){

        $m = new Product();
        $relation = $m->category();
        $this->assertInstanceOf(BelongsTo::class, $relation);

        $m = new Category();
        $relation = $m->childrens();
        $this->assertInstanceOf(HasMany::class, $relation);

        $relation = $m->parent();
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

}
