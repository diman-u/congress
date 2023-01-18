<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_create_and_login()
    {
        $this->browse(function (Browser $browser) {

            $user = User::factory()->create([
                'email' => 'uda@laravel.com',
            ]);

            $this->browse(function ($browser) use ($user) {
                $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->click('@login-btn')
                    ->assertPathIs('/account');
            });
        });
    }
}

