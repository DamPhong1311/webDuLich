<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('destinations')->truncate();
        DB::table('articles')->truncate();
         $this->call([
        DestinationSeeder::class,
        ArticleSeeder::class,
    ]);
    }
}
