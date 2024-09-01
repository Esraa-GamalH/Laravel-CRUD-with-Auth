<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * php artisan db:seed --class=AuthorSeeder
     */
    public function run(): void
    {
        //
        Author::factory()->count(10)->create();
    }
}
