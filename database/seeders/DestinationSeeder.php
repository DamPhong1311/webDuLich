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
            [
    'title' => 'Thác Bản Giốc',
    'excerpt' => 'Thác nước lớn nhất Việt Nam nằm giữa biên giới Việt - Trung.',
    'content' => 'Thác Bản Giốc thuộc tỉnh Cao Bằng, nổi tiếng với vẻ đẹp hùng vĩ, dòng nước trắng xóa và khung cảnh thiên nhiên hoang sơ, là điểm check-in hấp dẫn cho du khách.',
    'cover_image' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca',
    'gallery' => [
        'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
        'https://images.unsplash.com/photo-1493558103817-58b2924bce98',
    ],
    'location' => 'Cao Bằng',
    'province' => 'Cao Bằng',
    'featured' => false,
],
[
    'title' => 'Cố đô Huế',
    'excerpt' => 'Di sản văn hóa thế giới với quần thể di tích lịch sử lâu đời.',
    'content' => 'Huế là thành phố di sản nổi tiếng với Đại Nội, lăng tẩm các vua triều Nguyễn, chùa Thiên Mụ và dòng sông Hương thơ mộng.',
    'cover_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    'gallery' => [
        'https://images.unsplash.com/photo-1583394838336-acd977736f90',
        'https://images.unsplash.com/photo-1564501049412-61c2a3083791',
    ],
    'location' => 'Thừa Thiên Huế',
    'province' => 'Thừa Thiên Huế',
    'featured' => true,
],
[
    'title' => 'Vườn quốc gia Phong Nha - Kẻ Bàng',
    'excerpt' => 'Di sản thiên nhiên thế giới với hệ thống hang động kỳ vĩ.',
    'content' => 'Phong Nha - Kẻ Bàng thuộc tỉnh Quảng Bình, nổi tiếng với các hang động lớn như Sơn Đoòng, động Phong Nha, động Thiên Đường và hệ sinh thái đa dạng.',
    'cover_image' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e',
    'gallery' => [
        'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
        'https://images.unsplash.com/photo-1493558103817-58b2924bce98',
    ],
    'location' => 'Quảng Bình',
    'province' => 'Quảng Bình',
    'featured' => true,
],
[
    'title' => 'Biển Mỹ Khê',
    'excerpt' => 'Bãi biển đẹp nhất Đà Nẵng với cát trắng mịn và nước biển trong xanh.',
    'content' => 'Biển Mỹ Khê nằm ở thành phố Đà Nẵng, nổi tiếng với bãi tắm dài, nước biển trong xanh, thích hợp cho các hoạt động vui chơi, nghỉ dưỡng và thể thao biển.',
    'cover_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    'gallery' => [
        'https://images.unsplash.com/photo-1583394838336-acd977736f90',
        'https://images.unsplash.com/photo-1564501049412-61c2a3083791',
    ],
    'location' => 'Đà Nẵng',
    'province' => 'Đà Nẵng',
    'featured' => false,
],
[
    'title' => 'Núi Bà Đen',
    'excerpt' => 'Nóc nhà Nam Bộ với cảnh quan hùng vĩ và hệ thống cáp treo hiện đại.',
    'content' => 'Núi Bà Đen thuộc tỉnh Tây Ninh, nổi tiếng với độ cao 986m, là điểm đến lý tưởng cho du khách yêu thích leo núi, khám phá thiên nhiên và tham quan chùa Bà Đen linh thiêng.',
    'cover_image' => 'https://images.unsplash.com/photo-1519125323398-675f0ddb6308',
    'gallery' => [
        'https://images.unsplash.com/photo-1519985176271-adb1088fa94c',
        'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    ],
    'location' => 'Tây Ninh',
    'province' => 'Tây Ninh',
    'featured' => false,
],
[
    'title' => 'Hồ Hoàn Kiếm',
    'excerpt' => 'Biểu tượng của thủ đô Hà Nội với tháp Rùa cổ kính.',
    'content' => 'Hồ Hoàn Kiếm nằm giữa trung tâm Hà Nội, là nơi gắn liền với truyền thuyết vua Lê trả gươm và là điểm đến yêu thích của người dân và du khách.',
    'cover_image' => 'https://images.unsplash.com/photo-1465101178521-c1a4c8a0f8d9',
    'gallery' => [
        'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    ],
    'location' => 'Hà Nội',
    'province' => 'Hà Nội',
    'featured' => true,
],
[
    'title' => 'Bãi biển Nha Trang',
    'excerpt' => 'Bãi biển nổi tiếng với nước biển trong xanh và bãi cát trắng mịn.',
    'content' => 'Nha Trang là thành phố biển nổi tiếng của Việt Nam, thu hút du khách bởi vẻ đẹp thiên nhiên và các hoạt động vui chơi giải trí đa dạng.',
    'cover_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    'gallery' => [
        'https://images.unsplash.com/photo-1583394838336-acd977736f90',
    ],
    'location' => 'Khánh Hòa',
    'province' => 'Khánh Hòa',
    'featured' => false,
],
[
    'title' => 'Chùa Một Cột',
    'excerpt' => 'Ngôi chùa độc đáo với kiến trúc một cột giữa hồ sen.',
    'content' => 'Chùa Một Cột là một trong những biểu tượng văn hóa của Hà Nội, nổi bật với kiến trúc độc đáo và giá trị lịch sử lâu đời.',
    'cover_image' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca',
    'gallery' => [
        'https://images.unsplash.com/photo-1493558103817-58b2924bce98',
    ],
    'location' => 'Hà Nội',
    'province' => 'Hà Nội',
    'featured' => false,
],
[
    'title' => 'Đảo Cát Bà',
    'excerpt' => 'Hòn đảo lớn nhất vịnh Lan Hạ với cảnh quan hoang sơ.',
    'content' => 'Cát Bà nổi tiếng với bãi biển đẹp, vườn quốc gia và hệ sinh thái đa dạng, là điểm đến lý tưởng cho du khách yêu thiên nhiên.',
    'cover_image' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e',
    'gallery' => [
        'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    ],
    'location' => 'Hải Phòng',
    'province' => 'Hải Phòng',
    'featured' => false,
],
[
    'title' => 'Động Thiên Đường',
    'excerpt' => 'Hang động đẹp nhất ở Quảng Bình với nhũ đá kỳ ảo.',
    'content' => 'Động Thiên Đường thuộc vườn quốc gia Phong Nha - Kẻ Bàng, nổi tiếng với chiều dài hơn 31km và vẻ đẹp huyền bí của nhũ đá.',
    'cover_image' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e',
    'gallery' => [
        'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    ],
    'location' => 'Quảng Bình',
    'province' => 'Quảng Bình',
    'featured' => false,
],
[
    'title' => 'Thác Datanla',
    'excerpt' => 'Thác nước nổi tiếng với trò chơi mạo hiểm ở Đà Lạt.',
    'content' => 'Thác Datanla là điểm đến hấp dẫn với cảnh quan thiên nhiên và các hoạt động như trượt thác, zipline.',
    'cover_image' => 'https://images.unsplash.com/photo-1519125323398-675f0ddb6308',
    'gallery' => [
        'https://images.unsplash.com/photo-1519985176271-adb1088fa94c',
    ],
    'location' => 'Lâm Đồng',
    'province' => 'Lâm Đồng',
    'featured' => false,
],
[
    'title' => 'Chợ nổi Cái Răng',
    'excerpt' => 'Chợ nổi lớn nhất miền Tây với nét văn hóa sông nước đặc trưng.',
    'content' => 'Chợ nổi Cái Răng ở Cần Thơ là nơi buôn bán trên sông, thu hút du khách bởi sự nhộn nhịp và trải nghiệm độc đáo.',
    'cover_image' => 'https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2022/10/21/1107813/Cho-Noi-Cai-Rang-2_1.jpg',
    'gallery' => [
        'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    ],
    'location' => 'Cần Thơ',
    'province' => 'Cần Thơ',
    'featured' => false,
],
[
    'title' => 'Bà Nà Hills',
    'excerpt' => 'Khu du lịch nổi tiếng với Cầu Vàng và khí hậu mát mẻ quanh năm.',
    'content' => 'Bà Nà Hills ở Đà Nẵng nổi tiếng với kiến trúc châu Âu, Cầu Vàng và các hoạt động giải trí hấp dẫn.',
    'cover_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    'gallery' => [
        'https://images.unsplash.com/photo-1583394838336-acd977736f90',
    ],
    'location' => 'Đà Nẵng',
    'province' => 'Đà Nẵng',
    'featured' => true,
],
[
    'title' => 'Vườn quốc gia Cúc Phương',
    'excerpt' => 'Vườn quốc gia lâu đời nhất Việt Nam với hệ động thực vật phong phú.',
    'content' => 'Cúc Phương thuộc tỉnh Ninh Bình, nổi tiếng với rừng nguyên sinh, động vật quý hiếm và các tuyến du lịch sinh thái.',
    'cover_image' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e',
    'gallery' => [
        'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    ],
    'location' => 'Ninh Bình',
    'province' => 'Ninh Bình',
    'featured' => false,
],
[
    'title' => 'Đảo Nam Du',
    'excerpt' => 'Quần đảo hoang sơ với biển xanh và bãi cát trắng ở Kiên Giang.',
    'content' => 'Nam Du là điểm đến mới nổi với vẻ đẹp hoang sơ, thích hợp cho du khách yêu thích khám phá và trải nghiệm.',
    'cover_image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
    'gallery' => [
        'https://images.unsplash.com/photo-1493558103817-58b2924bce98',
    ],
    'location' => 'Kiên Giang',
    'province' => 'Kiên Giang',
    'featured' => false,
],
[
    'title' => 'Đảo Lý Sơn',
    'excerpt' => 'Hòn đảo núi lửa với cảnh quan độc đáo ở Quảng Ngãi.',
    'content' => 'Lý Sơn nổi tiếng với bãi biển đẹp, di tích lịch sử và đặc sản tỏi.',
    'cover_image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
    'gallery' => [
        'https://images.unsplash.com/photo-1493558103817-58b2924bce98',
    ],
    'location' => 'Quảng Ngãi',
    'province' => 'Quảng Ngãi',
    'featured' => false,
],
[
    'title' => 'Vườn quốc gia Tràm Chim',
    'excerpt' => 'Khu bảo tồn chim quý hiếm ở Đồng Tháp.',
    'content' => 'Tràm Chim nổi tiếng với hệ sinh thái ngập nước và các loài chim quý hiếm như sếu đầu đỏ.',
    'cover_image' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e',
    'gallery' => [
        'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
    ],
    'location' => 'Đồng Tháp',
    'province' => 'Đồng Tháp',
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
