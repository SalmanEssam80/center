<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            CategorySeeder::class
        ]);
        \App\Models\User::factory(50)->create();
        \App\Models\Employee::factory(51)->create();
        \App\Models\Company::factory(50)->create();
        \App\Models\Manager::factory(50)->create();
        \App\Models\Branch::factory(50)->create();
        \App\Models\ClassRoom::factory(50)->create();
        \App\Models\Vendor::factory(50)->create();
        \App\Models\Course::factory(50)->create();
        \App\Models\Post::factory(50)->create();

        foreach(range(1,50) as $num){
            Employee::find($num)->update(['user_id'=>$num]);
            Manager::find($num)->update(['company_id'=>$num]);
        }
    }
}
