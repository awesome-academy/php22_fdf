<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\CategoriesController;
use App\Models\Category;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_index_returns_view()
    {
        $controller = new CategoriesController();
        $view = $controller->index();
        $this->assertEquals('admin.categories.index', $view->getName());
        $this->assertArrayHasKey('categories', $view->getData());
    }

    public function test_create_returns_view()
    {
        $controller = new CategoriesController();
        $view = $controller->create();
        $this->assertEquals('admin.categories.create', $view->getName());
        $this->assertArrayHasKey('categories', $view->getData());
    }

    public function test_store_user()
    {
        $category =  Category::create([
            'name' => 'Cream',
            'description' => 'Cream',
            'parent_id' => 0,
            'slug' => Str::slug('Cream'),
            ]);
        $this->assertInstanceOf(Category::class, $category);
        $findCategory = Category::findOrFail($category->id);
        $this->assertEquals($findCategory->name, $category->name);
        $this->assertEquals($findCategory->description, $category->description);
        $this->assertEquals($findCategory->parent_id, $category->parent_id);
        $this->assertEquals($findCategory->slug, $category->slug);
    }

    public function test_edit_returns_view()
    {
        $controller = new CategoriesController();
        $view = $controller->edit(1);
        $this->assertEquals('admin.categories.edit', $view->getName());
        $this->assertArrayHasKey('category', $view->getData());
        $this->assertArrayHasKey('categories', $view->getData());
    }

    public function test_update_user()
    {
        $category =  Category::create([
            'name' => 'Cream',
            'description' => 'Cream',
            'parent_id' => 0,
            'slug' => Str::slug('Cream'),
        ]);
        $data = [
            'name' => 'Fruits',
            'description' => 'Fruits',
        ];
        $this->assertInstanceOf(Category::class, $category);
        $findCategory = Category::findOrFail($category->id);
        $categoryUp = $findCategory->update($data);
        $this->assertDatabaseHas('categories', [
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }

    public function test_user_destroy()
    {
        $category =  Category::create([
            'name' => 'Vegetarian',
            'description' => 'Vegetarian',
            'parent_id' => 0,
            'slug' => Str::slug('Vegetarian'),
        ]);
        $this->assertInstanceOf(Category::class, $category);
        $success = $category->delete();
        $this->assertTrue($success);
        $this->assertDatabaseMissing('categories', [
            'name' => $category->name,
            'description' => $category->description,
            'slug' => $category->slug,
        ]);
    }
}
