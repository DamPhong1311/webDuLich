<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'title' => 'Vịnh Hạ Long',
                'excerpt' => 'Kỳ quan thiên nhiên thế giới với hàng ngàn đảo đá vôi tuyệt đẹp.',
                'content' => 'Vịnh Hạ Long là điểm du lịch nổi tiếng của Việt Nam, được UNESCO công nhận là Di sản Thiên nhiên Thế giới. Nơi đây có hàng ngàn hòn đảo đá vôi lớn nhỏ và là điểm đến lý tưởng cho du khách yêu thích cảnh đẹp và du thuyền.',
                'cover_image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
                'gallery' => [
                    'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
                    'https://images.unsplash.com/photo-1493558103817-58b2924bce98',
                ],
                'location' => 'Quảng Ninh',
                'province' => 'Quảng Ninh',
                'featured' => true,
            ],
            [
                'title' => 'Sa Pa Mờ Sương',
                'excerpt' => 'Thị trấn trong mây với ruộng bậc thang hùng vĩ.',
                'content' => 'Sa Pa là điểm du lịch nổi tiếng thuộc tỉnh Lào Cai, nằm ở độ cao 1.600m. Nơi đây thu hút du khách bởi khí hậu mát mẻ quanh năm và vẻ đẹp của ruộng bậc thang cùng văn hoá các dân tộc thiểu số.',
                'cover_image' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90',
                'gallery' => [
                    'https://images.unsplash.com/photo-1508672019048-805c876b67e2',
                    'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
                ],
                'location' => 'Lào Cai',
                'province' => 'Lào Cai',
                'featured' => false,
            ],
            [
                'title' => 'Hội An Cổ Kính',
                'excerpt' => 'Phố cổ lung linh đèn lồng mỗi đêm.',
                'content' => 'Hội An là thành phố cổ được UNESCO công nhận là Di sản Văn hoá Thế giới. Phố cổ nằm ven sông Thu Bồn, nổi bật với những căn nhà cổ, những con đường rực rỡ ánh đèn lồng và nền ẩm thực đặc sắc.',
                'cover_image' => 'https://images.unsplash.com/photo-1586902197503-e71026292412',
                'gallery' => [
                    'https://images.unsplash.com/photo-1564501049412-61c2a3083791',
                    'https://images.unsplash.com/photo-1583394838336-acd977736f90',
                ],
                'location' => 'Quảng Nam',
                'province' => 'Quảng Nam',
                'featured' => true,
            ],
            [
                'title' => 'Phú Quốc - Đảo Ngọc',
                'excerpt' => 'Thiên đường biển xanh và cát trắng của Việt Nam.',
                'content' => 'Phú Quốc là hòn đảo lớn nhất Việt Nam, nổi tiếng với bãi biển tuyệt đẹp, nước biển trong xanh và nhiều khu nghỉ dưỡng cao cấp. Đây là điểm đến lý tưởng cho du khách muốn tận hưởng kỳ nghỉ yên bình.',
                'cover_image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
                'gallery' => [
                    'https://images.unsplash.com/photo-1493558103817-58b2924bce98',
                    'https://images.unsplash.com/photo-1470770903676-69b98201ea1c',
                ],
                'location' => 'Kiên Giang',
                'province' => 'Kiên Giang',
                'featured' => false,
            ],
            [
                'title' => 'Đà Lạt - Thành phố ngàn hoa',
                'excerpt' => 'Nơi có khí hậu mát mẻ quanh năm và phong cảnh thơ mộng.',
                'content' => 'Đà Lạt nằm ở vùng cao nguyên Lâm Viên, nổi tiếng với khí hậu se lạnh, hồ Xuân Hương, thung lũng tình yêu và những vườn hoa rực rỡ quanh năm.',
                'cover_image' => 'https://peacetour.com.vn/Upload/Article/58338be3-c41f-4347-8736-085290d785bf/hoa-da-lat-cam-tu-cau-1.jpeg ',
                'gallery' => [
                    'https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2022/10/21/1107548/73556-Vuon-Hoa-Thanh.jpg',
                    'https://statics.vinpearl.com/vuon-hoa-da-lat-1_1687257202.jpg',
                ],
                'location' => 'Lâm Đồng',
                'province' => 'Lâm Đồng',
                'featured' => false,
            ],
        ];

        foreach ($destinations as $item) {
            Destination::create([
                ...$item,
                'slug' => Str::slug($item['title']),
                'published_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
