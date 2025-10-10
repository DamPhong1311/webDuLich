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
        $user = User::first() ?? User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $articles = [
            [
                'title' => '10 điểm du lịch đẹp nhất Việt Nam',
                'excerpt' => 'Khám phá những địa danh tuyệt đẹp từ Bắc chí Nam bạn không nên bỏ lỡ.',
                'content' => 'Việt Nam sở hữu cảnh quan đa dạng từ núi rừng Tây Bắc đến biển đảo miền Trung và miền Nam. Hãy cùng chúng tôi khám phá những điểm đến hấp dẫn nhất.',
                'cover_image' => 'https://images.unsplash.com/photo-1493558103817-58b2924bce98',
            ],
            [
                'title' => 'Kinh nghiệm du lịch Đà Lạt tự túc 3 ngày 2 đêm',
                'excerpt' => 'Hướng dẫn chi tiết giúp bạn có chuyến đi Đà Lạt tiết kiệm và đáng nhớ.',
                'content' => 'Đà Lạt là điểm du lịch lý tưởng quanh năm. Bài viết chia sẻ lịch trình gợi ý và mẹo nhỏ để khám phá Đà Lạt một cách trọn vẹn nhất.',
                'cover_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
            ],
            [
                'title' => 'Khám phá Hội An - Phố cổ di sản thế giới',
                'excerpt' => 'Hội An là nơi lưu giữ những giá trị văn hoá cổ xưa và ẩm thực đặc trưng của miền Trung.',
                'content' => 'Tản bộ trong phố cổ, thưởng thức cao lầu, và ngắm đèn lồng lung linh về đêm là những trải nghiệm khó quên tại Hội An.',
                'cover_image' => 'https://images.unsplash.com/photo-1586902197503-e71026292412',
            ],
            [
                'title' => 'Chợ nổi miền Tây – Nét văn hoá độc đáo vùng sông nước',
                'excerpt' => 'Trải nghiệm chợ nổi Cái Răng, nếm trái cây tươi và cà phê trên ghe.',
                'content' => 'Miền Tây mang đến trải nghiệm độc đáo với chợ nổi, kênh rạch và văn hoá sông nước đậm đà bản sắc Việt.',
                'cover_image' => 'https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2022/10/21/1107813/Cho-Noi-Cai-Rang-2_1.jpg',
            ],
            [
                'title' => 'Phú Quốc – Thiên đường biển đảo Việt Nam',
                'excerpt' => 'Phú Quốc là điểm đến hoàn hảo để nghỉ dưỡng và tận hưởng biển xanh cát trắng.',
                'content' => 'Hãy cùng khám phá những bãi biển đẹp, khu nghỉ dưỡng sang trọng và ẩm thực phong phú trên đảo ngọc Phú Quốc.',
                'cover_image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
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
