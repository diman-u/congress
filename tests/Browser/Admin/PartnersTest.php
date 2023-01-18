<?php

namespace Tests\Browser\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Spatie\Permission\Models\Role;
use Tests\DuskTestCase;
use App\Models\User;

class PartnersTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_add_partners()
    {
        $user = User::factory()->create([
            'email' => 'uda@laravel.com',
        ]);

        $role = Role::create(['name' => 'admin']);
        $user->assignRole($role);

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/admin/partners')
                ->assertSee('Добавить partners')
                ->press('@add')
                ->type('link', 'Тест')
                ->type('image', 'Тест')
                ->press('@btn-save-back')
                ->waitFor('@add_success')
                ->assertSee('Запись была успешно добавлена');
        });
    }
}
