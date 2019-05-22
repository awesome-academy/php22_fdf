<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\StoreController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_index_returns_view()
    {
        $controller = new StoreController();
        $view = $controller->index();
        $this->assertEquals('index', $view->getName());
        $this->assertArrayHasKey('categories', $view->getData());
        $this->assertArrayHasKey('products', $view->getData());
    }

    public function test_singleCategory_returns_view()
    {
        $category =  Category::create([
            'name' => 'Cream',
            'description' => 'Cream',
            'parent_id' => 0,
            'slug' => Str::slug('Cream'),
        ]);
        $this->assertInstanceOf(Category::class, $category);
        $controller = new StoreController();
        $view = $controller->singleCategory($category->slug);
        $findCategory = Category::findOrFail($category->id);
        $this->assertEquals('category', $view->getName());
        $this->assertArrayHasKey('category', $view->getData());
        $this->assertArrayHasKey('products', $view->getData());
    }
}
