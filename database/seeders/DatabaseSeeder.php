<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạm thời tắt kiểm tra khóa ngoại để có thể truncate bảng
        Schema::disableForeignKeyConstraints();

        // Xóa sạch dữ liệu cũ trong các bảng.
        // Bảng có khóa ngoại phải được xóa trước.
        DB::table('favorites')->truncate();
        DB::table('saved_destinations')->truncate();
        DB::table('articles')->truncate();
        DB::table('destinations')->truncate();
        DB::table('users')->truncate();
        DB::table('contacts')->truncate();

        // Bật lại kiểm tra khóa ngoại
        Schema::enableForeignKeyConstraints();

        // Gọi các seeder để điền dữ liệu mới
        $this->call([
            DestinationSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
