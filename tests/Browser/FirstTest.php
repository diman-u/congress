<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class FirstTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_first()
    {
        User::factory()->create([
            'email' => 'uda@laravel.com',
        ]);

        $this->browse(function (Browser $browser) {

            $browser->loginAs(User::find(1))
                ->visit('/account')
                ->assertSee('Личный кабинет');
        });
    }
}
