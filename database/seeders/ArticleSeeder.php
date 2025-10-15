<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Đảm bảo có ít nhất một user để gán bài viết
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]);
        }

        $articles = [
            [
                'title' => '10 điểm du lịch đẹp nhất Việt Nam',
                'excerpt' => 'Khám phá những địa danh tuyệt đẹp từ Bắc chí Nam bạn không nên bỏ lỡ.',
                'content' => 'Việt Nam sở hữu cảnh quan đa dạng từ núi rừng Tây Bắc đến biển đảo miền Trung và miền Nam.',
                'cover_image' => 'https://images.unsplash.com/photo-1493558103817-58b2924bce98',
            ],
            [
                'title' => 'Kinh nghiệm du lịch Đà Lạt tự túc 3 ngày 2 đêm',
                'excerpt' => 'Hướng dẫn chi tiết giúp bạn có chuyến đi Đà Lạt tiết kiệm và đáng nhớ.',
                'content' => 'Đà Lạt là điểm du lịch lý tưởng quanh năm. Bài viết chia sẻ lịch trình gợi ý và mẹo nhỏ để khám phá Đà Lạt.',
                'cover_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
            ],
             [
                'title' => 'Khám phá Hội An - Phố cổ di sản thế giới',
                'excerpt' => 'Hội An là nơi lưu giữ những giá trị văn hoá cổ xưa và ẩm thực đặc trưng của miền Trung.',
                'content' => 'Tản bộ trong phố cổ, thưởng thức cao lầu, và ngắm đèn lồng lung linh về đêm là những trải nghiệm khó quên tại Hội An.',
                'cover_image' => 'https://images.unsplash.com/photo-1586902197503-e71026292412',
            ],
        ];

        foreach ($articles as $item) {
            Article::create([
                ...$item,
                'slug' => Str::slug($item['title']),
                'user_id' => $user->id,
                'published_at' => Carbon::now()->subDays(rand(1, 15)),
            ]);
        }
    }
}

