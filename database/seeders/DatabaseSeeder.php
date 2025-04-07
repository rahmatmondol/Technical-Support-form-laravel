<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $mainAdmin = User::factory()->create([
            'name' => 'Admin',
            'password' => bcrypt('12345678'),
            'email' => 'admin@admin.com',
        ]);
        // $editor = User::factory()->create([
        //     'name' => 'Editor',
        //     'password' => bcrypt('12345678'),
        //     'email' => 'editor@editor.com',
        // ]);
        // $this->call([
        //     FormSeeder::class,
        // ]);

        // Create permissions first
        $permissions = [
            'create form',
            'edit form',
            'delete form',
            'view form',
            'create service',
            'edit service',
            'delete service',
            'view service',
            'create editor',
            'edit editor',
            'delete editor',
            'view editor',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);

        $adminRole->givePermissionTo($permissions);

        $editorRole->givePermissionTo([
            'view form',
            'create form',
        ]);

        // make roles
        $mainAdmin->assignRole('admin');
        // $editor->assignRole('editor');
    }
}
