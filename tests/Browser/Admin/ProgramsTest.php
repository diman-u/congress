<?php

namespace Tests\Browser\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ProgramsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_add_programs()
    {
        $user = User::factory()->create([
            'email' => 'uda@laravel.com',
        ]);

        $role = Role::create(['name' => 'admin']);
        $user->assignRole($role);

        $this->browse(function (Browser $browser) {

            $browser->loginAs(User::find(1))
                ->visit('/admin/programs')
                ->assertSee('Добавить programs')
                ->press('@add')
                ->type('date', 'Тест')
                ->type('time', 'Тест')
                ->type('title', 'Тест')
                ->press('@btn-save-back')
                ->waitFor('@add_success')
                ->assertSee('Запись была успешно добавлена');
        });
    }
}
