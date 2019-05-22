<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_index_returns_view()
    {
        $controller = new ProductController();
        $view = $controller->index();
        $this->assertEquals('admin.include.product', $view->getName());
        $this->assertArrayHasKey('products', $view->getData());
        $this->assertArrayHasKey('index', $view->getData());
    }

    public function test_create_returns_view()
    {
        $controller = new ProductController();
        $view = $controller->create();
        $this->assertEquals('admin.products.create', $view->getName());
        $this->assertArrayHasKey('categories', $view->getData());
    }

    public function test_store_user()
    {
        $product= factory(Product::class)->create();
        $this->assertInstanceOf(Product::class, $product);
        $findProduct = Product::findOrFail($product->id);
        $this->assertEquals($findProduct->name, $product->name);
        $this->assertEquals($findProduct->category_id, $product->category_id);
        $this->assertEquals($findProduct->description, $product->description);
        $this->assertEquals($findProduct->price, $product->price);
        $this->assertEquals($findProduct->quantity, $product->quantity);
        $this->assertEquals($findProduct->discount, $product->discount);
        $this->assertEquals($findProduct->rating, $product->rating);
    }

    public function test_edit_returns_view()
    {
        $controller = new ProductController();
        $view = $controller->edit(1);
        $this->assertEquals('admin.products.edit', $view->getName());
        $this->assertArrayHasKey('product', $view->getData());
        $this->assertArrayHasKey('categories', $view->getData());
    }

    public function test_update_user()
    {
        $productnew= factory(Product::class)->create();
        $data = [
            'name' => 'Soda',
            'quantity' => 100,
            'price' => 3,
        ];
        $this->assertInstanceOf(Product::class, $productnew);
        $findProduct = Product::findOrFail($productnew->id);
        $productUp = $findProduct->update($data);
        $this->assertDatabaseHas('products', [
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
        ]);
    }

    public function test_product_destroy()
    {
        $product = factory(Product::class)->create();
        $this->assertInstanceOf(Product::class, $product);
        $success = $product->delete();
        $this->assertTrue($success);
        $this->assertSoftDeleted('products', [
            'id' => $product->id,
            'name' => $product->name,
        ]);
    }

    public function test_trashed_returns_view()
    {
        $controller = new ProductController();
        $view = $controller->trashed();
        $this->assertEquals('admin.include.product', $view->getName());
        $this->assertArrayHasKey('products', $view->getData());
        $this->assertArrayHasKey('index', $view->getData());
    }

    public function test_product_kill()
    {
        $product = factory(Product::class)->create();
        $this->assertInstanceOf(Product::class, $product);
        $success = $product->delete();
        $controller = new ProductController();
        $killproduct = $controller->kill($product->id);
        $this->assertDatabaseMissing('products', [
            'name' => $product->name,
            'id' => $product->id,
        ]);
    }

    public function test_product_restore()
    {
        $product = factory(Product::class)->create();
        $this->assertInstanceOf(Product::class, $product);
        $success = $product->delete();
        $controller = new ProductController();
        $restoreproduct = $controller->restore($product->id);
        $this->assertDatabaseHas('products', [
            'name' => $product->name,
            'id' => $product->id,
        ]);
    }

}
