<?php

namespace Tests\Browser\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class QuotesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_add_quotes()
    {
        $user = User::factory()->create([
            'email' => 'uda@laravel.com',
        ]);

        $role = Role::create(['name' => 'admin']);
        $user->assignRole($role);

        $this->browse(function (Browser $browser) {

            $browser->loginAs(User::find(1))
                ->visit('/admin/quotes')
                ->assertSee('Добавить quotes')
                ->press('@add')
                ->type('date', 'Первая новость')
                ->type('fio', 'first-news')
                ->type('text', 'Описание новости')
                ->press('@btn-save-back')
                ->assertPathIs('/admin/quotes');
        });
    }
}
