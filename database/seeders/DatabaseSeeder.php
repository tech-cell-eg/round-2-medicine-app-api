<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Password;
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
        // Notification::factory(10)->create();
        // Category::factory(10)->create();
        // SubCategory::factory(20)->create();
        Product::factory(50)->create();
        // Cart::factory(10)->create();
        // Comment::factory(100)->create();
        // $permissions = [
        //     'create_products', 'edit_products', 'delete_products', 'view_products',
        //     'create_users', 'edit_users', 'delete_users', 'view_users',
        // ];
        
        
        // foreach ($permissions as $permission) {
        //     Permission::create(['name' => $permission]);
        // }
        
       
        // $adminRole = Role::create(['name' => 'super_admin']);
        // $adminRole->givePermissionTo($permissions);
        
        // $user = User::factory()->create([
        //     'name' => 'sara',
        //     'email' => 'sara666.s47@gmail.com',
        //     'phone' => '01129017516',
        //     'password' => Hash::make('passwors123'),
        //     'role' => 'super_admin'
        // ]);
        
        // $user->assignRole('super_admin');
        
    }
}
