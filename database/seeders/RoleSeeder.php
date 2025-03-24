<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        // DB::table('roles')->insert([
        //     'name' => 'admin',
        //     'description' => 'Administrator',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        Role::factory()->count(9)->create();
    }
}
