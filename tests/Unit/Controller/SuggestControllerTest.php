<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\SuggestController;
use App\Models\Suggest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuggestControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_index_returns_view()
    {
        $controller = new SuggestController();
        $view = $controller->index();
        $this->assertEquals('admin.suggest.index', $view->getName());
        $this->assertArrayHasKey('suggests', $view->getData());
    }

    public function test_change_status_suggest()
    {
        $findSuggest = Suggest::findOrFail(1);
        $controller = new SuggestController();
        $view = $controller->changeStatus($findSuggest->id, $findSuggest->status);
        $findSuggestUpdateStatus = Suggest::findOrFail(1);
        $this->assertNotEquals($findSuggest->status, $findSuggestUpdateStatus->status);
    }
}
