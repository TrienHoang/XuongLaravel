<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\PostComment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            UploadFileSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductCommentSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            CartSeeder::class,
            CartDetailSeeder::class,
            PostSeeder::class,
            PostCommentSeeder::class,
            AlbumProductSeeder::class
        ]);
    }
}
