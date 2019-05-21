<?php

namespace Tests\Unit\Models;


use App\Models\FeedBack;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_contains_valid_fillable_properties()
    {
        $m = new User();
        $this->assertEquals([
            'name',
            'email',
            'password',
            'address',
            'phone',
            'is_admin',
            ], $m->getFillable());

    }

    public function test_user_relation(){

        $m = new Transaction();
        $relation = $m->user();
        $this->assertInstanceOf(BelongsTo::class, $relation);

        $m = new FeedBack();
        $relation = $m->user();
        $this->assertInstanceOf(BelongsTo::class, $relation);

    }

    public function test_status_getter(){
        $m = new User();

        $m->setAttribute('is_admin', 1);
        $this->assertEquals(1, $m->getAttributes()['is_admin']);
    }
}
