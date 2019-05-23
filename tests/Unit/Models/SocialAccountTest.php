<?php

namespace Tests\Unit\Models;

use App\Models\SocialAccount;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SocialAccountTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_contains_valid_fillable_properties()
    {
        $m = new SocialAccount();
        $this->assertEquals([
            'user_id',
            'provider_user_id',
            'provider',
        ], $m->getFillable());

    }

    public function test_social_account_Relation(){
        $m = new SocialAccount();
        $relation = $m->user();
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }
}
