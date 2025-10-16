<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinations = [
            // MIỀN BẮC
            [
                'title' => 'Vịnh Hạ Long, Quảng Ninh',
                'excerpt' => 'Kỳ quan thiên nhiên thế giới với hàng ngàn đảo đá vôi hùng vĩ trên làn nước xanh ngọc.',
                'content' => 'Vịnh Hạ Long là một trong những điểm đến không thể bỏ qua khi du lịch Việt Nam. Du khách có thể trải nghiệm du thuyền qua đêm, chèo kayak khám phá các hang động và tận hưởng cảnh hoàng hôn tuyệt đẹp trên vịnh.',
                'cover_image' => 'https://images.pexels.com/photos/2363359/pexels-photo-2363359.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/931007/pexels-photo-931007.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                    'https://images.pexels.com/photos/1601042/pexels-photo-1601042.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Hạ Long',
                'province' => 'Quảng Ninh',
                'featured' => true,
            ],
            [
                'title' => 'Sa Pa, Lào Cai',
                'excerpt' => 'Thị trấn trong mây với những thửa ruộng bậc thang kỳ vĩ và văn hóa dân tộc đặc sắc.',
                'content' => 'Sa Pa là điểm đến lý tưởng cho những ai yêu thích trekking và khám phá thiên nhiên. Nơi đây nổi tiếng với đỉnh Fansipan - nóc nhà Đông Dương, thung lũng Mường Hoa và những bản làng của người H\'Mông, Dao.',
                'cover_image' => 'https://images.pexels.com/photos/1107717/pexels-photo-1107717.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/2440021/pexels-photo-2440021.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                    'https://images.pexels.com/photos/773594/pexels-photo-773594.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Sa Pa',
                'province' => 'Lào Cai',
                'featured' => true,
            ],
            [
                'title' => 'Quần thể danh thắng Tràng An, Ninh Bình',
                'excerpt' => '"Vịnh Hạ Long trên cạn" với hệ thống hang động, núi đá vôi và các di tích lịch sử.',
                'content' => 'Du khách sẽ được ngồi thuyền nan xuôi dòng sông Sào Khê, len lỏi qua các hang động kỳ bí và viếng thăm các ngôi đền, chùa cổ kính. Tràng An là một di sản thế giới hỗn hợp của UNESCO.',
                'cover_image' => 'https://images.pexels.com/photos/1529356/pexels-photo-1529356.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/3283186/pexels-photo-3283186.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                    'https://images.pexels.com/photos/8086036/pexels-photo-8086036.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Hoa Lư',
                'province' => 'Ninh Bình',
                'featured' => true,
            ],
            [
                'title' => 'Phố cổ Hà Nội',
                'excerpt' => 'Trái tim của thủ đô ngàn năm văn hiến với những con phố nghề và ẩm thực đường phố hấp dẫn.',
                'content' => 'Khu phố cổ Hà Nội là một mê cung của những con đường nhỏ, những ngôi nhà cổ kính và những gánh hàng rong. Đây là nơi tuyệt vời để đi dạo, thưởng thức cà phê trứng, phở và khám phá cuộc sống địa phương.',
                'cover_image' => 'https://images.pexels.com/photos/2507027/pexels-photo-2507027.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/4038850/pexels-photo-4038850.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Hoàn Kiếm',
                'province' => 'Hà Nội',
                'featured' => false,
            ],
            [
                'title' => 'Cao nguyên đá Đồng Văn, Hà Giang',
                'excerpt' => 'Vẻ đẹp hoang sơ, hùng vĩ của núi non cực Bắc Việt Nam với những cung đường đèo ngoạn mục.',
                'content' => 'Hà Giang thu hút du khách, đặc biệt là các phượt thủ, bởi những cung đường uốn lượn như đèo Mã Pí Lèng, những cánh đồng hoa tam giác mạch và cuộc sống của các dân tộc thiểu số.',
                'cover_image' => 'https://images.pexels.com/photos/10002016/pexels-photo-10002016.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/847402/pexels-photo-847402.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Đồng Văn',
                'province' => 'Hà Giang',
                'featured' => false,
            ],
            [
                'title' => 'Thác Bản Giốc, Cao Bằng',
                'excerpt' => 'Một trong những thác nước hùng vĩ và đẹp nhất Đông Nam Á, nằm trên biên giới Việt - Trung.',
                'content' => 'Thác Bản Giốc mang vẻ đẹp kỳ vĩ với những tầng nước đổ xuống trắng xóa. Du khách có thể đi thuyền để lại gần chân thác, cảm nhận sự mát lạnh và chiêm ngưỡng trọn vẹn vẻ đẹp của nó.',
                'cover_image' => 'https://images.pexels.com/photos/10129759/pexels-photo-10129759.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Trùng Khánh',
                'province' => 'Cao Bằng',
                'featured' => false,
            ],
            [
                'title' => 'Mù Cang Chải, Yên Bái',
                'excerpt' => 'Thiên đường của những thửa ruộng bậc thang vàng óng mùa lúa chín.',
                'content' => 'Vào khoảng tháng 9, tháng 10 hàng năm, Mù Cang Chải khoác lên mình một màu vàng rực rỡ của lúa chín, tạo nên một bức tranh thiên nhiên tuyệt đẹp, thu hút các nhiếp ảnh gia và du khách.',
                'cover_image' => 'https://images.pexels.com/photos/3224164/pexels-photo-3224164.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Mù Cang Chải',
                'province' => 'Yên Bái',
                'featured' => false,
            ],
            [
                'title' => 'Đảo Cát Bà, Hải Phòng',
                'excerpt' => 'Hòn ngọc của Vịnh Bắc Bộ, nơi có Vườn Quốc gia và những bãi biển hoang sơ.',
                'content' => 'Cát Bà là hòn đảo lớn nhất trong quần thể Vịnh Lan Hạ. Du khách có thể tắm biển tại các bãi Cát Cò, trekking trong vườn quốc gia hoặc chèo thuyền kayak khám phá các làng chài.',
                'cover_image' => 'https://images.pexels.com/photos/9944747/pexels-photo-9944747.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Cát Hải',
                'province' => 'Hải Phòng',
                'featured' => false,
            ],
            // MIỀN TRUNG
            [
                'title' => 'Phố cổ Hội An, Quảng Nam',
                'excerpt' => 'Di sản văn hóa thế giới với những ngôi nhà cổ, dòng sông Hoài thơ mộng và đêm phố lung linh đèn lồng.',
                'content' => 'Hội An mang một vẻ đẹp trầm mặc, cổ kính. Dạo bước trên những con phố nhỏ, thưởng thức ẩm thực đặc sắc như Cao Lầu, Mì Quảng và thả hoa đăng trên sông Hoài là những trải nghiệm không thể quên.',
                'cover_image' => 'https://images.pexels.com/photos/3584437/pexels-photo-3584437.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/1007427/pexels-photo-1007427.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Hội An',
                'province' => 'Quảng Nam',
                'featured' => true,
            ],
            [
                'title' => 'Cố đô Huế',
                'excerpt' => 'Vùng đất của di sản, nơi lưu giữ những giá trị lịch sử và văn hóa của triều đại nhà Nguyễn.',
                'content' => 'Huế nổi tiếng với quần thể di tích Đại Nội, các lăng tẩm của vua chúa, chùa Thiên Mụ cổ kính và dòng sông Hương thơ mộng. Ẩm thực Huế cũng là một nét đặc sắc không thể bỏ lỡ.',
                'cover_image' => 'https://images.pexels.com/photos/415708/pexels-photo-415708.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/7124334/pexels-photo-7124334.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Huế',
                'province' => 'Thừa Thiên Huế',
                'featured' => false,
            ],
            [
                'title' => 'Cầu Vàng, Đà Nẵng',
                'excerpt' => 'Cây cầu độc đáo được nâng đỡ bởi đôi bàn tay khổng lồ trên đỉnh Bà Nà.',
                'content' => 'Nằm trong khu du lịch Sun World Ba Na Hills, Cầu Vàng đã trở thành một biểu tượng mới của du lịch Đà Nẵng, thu hút hàng triệu du khách trong nước và quốc tế đến chiêm ngưỡng và chụp ảnh.',
                'cover_image' => 'https://images.pexels.com/photos/1098460/pexels-photo-1098460.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/2249959/pexels-photo-2249959.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Hòa Vang',
                'province' => 'Đà Nẵng',
                'featured' => true,
            ],
            [
                'title' => 'Vườn Quốc gia Phong Nha - Kẻ Bàng, Quảng Bình',
                'excerpt' => 'Vương quốc hang động của thế giới với những hang động kỳ vĩ như Sơn Đoòng, Thiên Đường.',
                'content' => 'Phong Nha - Kẻ Bàng là di sản thiên nhiên thế giới, nổi tiếng với hệ thống hang động đá vôi và sông ngầm. Đây là điểm đến cho những ai yêu thích khám phá và mạo hiểm.',
                'cover_image' => 'https://images.pexels.com/photos/9920333/pexels-photo-9920333.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Bố Trạch',
                'province' => 'Quảng Bình',
                'featured' => false,
            ],
            [
                'title' => 'Biển Nha Trang, Khánh Hòa',
                'excerpt' => 'Thành phố biển sôi động với vịnh biển được xếp vào hàng đẹp nhất thế giới.',
                'content' => 'Nha Trang là thiên đường nghỉ dưỡng với bãi cát trắng trải dài, nước biển trong xanh và nhiều hòn đảo xinh đẹp. Du khách có thể tham gia các hoạt động lặn biển, lướt sóng hoặc thư giãn tại các resort sang trọng.',
                'cover_image' => 'https://images.pexels.com/photos/3601453/pexels-photo-3601453.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/1591373/pexels-photo-1591373.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Nha Trang',
                'province' => 'Khánh Hòa',
                'featured' => false,
            ],
            [
                'title' => 'Đà Lạt, Lâm Đồng',
                'excerpt' => 'Thành phố ngàn hoa với khí hậu mát mẻ quanh năm và khung cảnh lãng mạn.',
                'content' => 'Đà Lạt là nơi trốn nóng lý tưởng với những đồi thông, hồ nước, thác nước và vô số loài hoa. Nơi đây còn được mệnh danh là "tiểu Paris" của Việt Nam.',
                'cover_image' => 'https://images.pexels.com/photos/2102587/pexels-photo-2102587.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/931018/pexels-photo-931018.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Đà Lạt',
                'province' => 'Lâm Đồng',
                'featured' => true,
            ],
            [
                'title' => 'Eo Gió, Quy Nhơn',
                'excerpt' => 'Nơi ngắm bình minh đẹp nhất Việt Nam với những rặng núi đá cao vươn ra biển.',
                'content' => 'Eo Gió thuộc thành phố Quy Nhơn, tỉnh Bình Định. Nơi đây có con đường đi bộ ven biển tuyệt đẹp uốn lượn theo sườn núi, là điểm check-in không thể bỏ qua khi đến với "thành phố thi ca".',
                'cover_image' => 'https://images.pexels.com/photos/11995804/pexels-photo-11995804.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Quy Nhơn',
                'province' => 'Bình Định',
                'featured' => false,
            ],
            [
                'title' => 'Đồi cát Mũi Né, Phan Thiết',
                'excerpt' => '"Tiểu sa mạc" của Việt Nam với những đồi cát đỏ và trắng mênh mông.',
                'content' => 'Mũi Né là điểm đến độc đáo với những đồi cát thay đổi hình dạng liên tục. Du khách có thể trải nghiệm trò chơi trượt cát, đi xe jeep khám phá và ngắm hoàng hôn trên đồi cát.',
                'cover_image' => 'https://images.pexels.com/photos/2387793/pexels-photo-2387793.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Mũi Né',
                'province' => 'Bình Thuận',
                'featured' => false,
            ],
            // MIỀN NAM
            [
                'title' => 'Đảo Phú Quốc, Kiên Giang',
                'excerpt' => 'Đảo ngọc với những bãi biển đẹp nhất Việt Nam như Bãi Sao, Bãi Khem và hệ sinh thái đa dạng.',
                'content' => 'Phú Quốc là hòn đảo lớn nhất Việt Nam, một thiên đường nghỉ dưỡng với biển xanh, cát trắng, nắng vàng. Nơi đây còn nổi tiếng với các khu resort sang trọng, chợ đêm và đặc sản nước mắm.',
                'cover_image' => 'https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [
                    'https://images.pexels.com/photos/2496880/pexels-photo-2496880.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ],
                'location' => 'Phú Quốc',
                'province' => 'Kiên Giang',
                'featured' => true,
            ],
            [
                'title' => 'Chợ nổi Cái Răng, Cần Thơ',
                'excerpt' => 'Nét văn hóa đặc trưng của vùng sông nước miền Tây, nơi buôn bán tấp nập trên sông.',
                'content' => 'Đến Chợ nổi Cái Răng vào sáng sớm, du khách sẽ được trải nghiệm không khí nhộn nhịp, thưởng thức bữa sáng ngay trên thuyền với các món đặc sản và mua trái cây tươi ngon từ các ghe hàng.',
                'cover_image' => 'https://images.pexels.com/photos/8979927/pexels-photo-8979927.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Cái Răng',
                'province' => 'Cần Thơ',
                'featured' => false,
            ],
            [
                'title' => 'Dinh Độc Lập, TP. Hồ Chí Minh',
                'excerpt' => 'Di tích lịch sử quan trọng, biểu tượng của ngày thống nhất đất nước 30/04/1975.',
                'content' => 'Dinh Độc Lập, hay Dinh Thống Nhất, là nơi ghi dấu nhiều sự kiện lịch sử trọng đại của Việt Nam. Du khách đến đây có thể tham quan kiến trúc độc đáo và tìm hiểu về lịch sử cận đại của đất nước.',
                'cover_image' => 'https://images.pexels.com/photos/13854720/pexels-photo-13854720.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Quận 1',
                'province' => 'TP. Hồ Chí Minh',
                'featured' => false,
            ],
            [
                'title' => 'Côn Đảo, Bà Rịa - Vũng Tàu',
                'excerpt' => 'Hòn đảo linh thiêng với quá khứ lịch sử và vẻ đẹp hoang sơ, yên bình.',
                'content' => 'Côn Đảo từng được mệnh danh là "địa ngục trần gian" nhưng nay đã trở thành thiên đường du lịch với những bãi biển trong vắt, rạn san hô đa dạng và không gian tĩnh lặng, thích hợp cho nghỉ dưỡng và du lịch tâm linh.',
                'cover_image' => 'https://images.pexels.com/photos/103123/pexels-photo-103123.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Côn Đảo',
                'province' => 'Bà Rịa - Vũng Tàu',
                'featured' => false,
            ],
            [
                'title' => 'Địa đạo Củ Chi, TP. Hồ Chí Minh',
                'excerpt' => 'Hệ thống phòng thủ dưới lòng đất, một kỳ quan quân sự trong cuộc kháng chiến.',
                'content' => 'Tham quan Địa đạo Củ Chi, du khách sẽ được trải nghiệm cuộc sống dưới lòng đất của quân và dân Việt Nam, khám phá hệ thống đường hầm, bếp Hoàng Cầm và thử món khoai mì chấm muối vừng.',
                'cover_image' => 'https://images.pexels.com/photos/13854720/pexels-photo-13854720.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Củ Chi',
                'province' => 'TP. Hồ Chí Minh',
                'featured' => false,
            ],
            [
                'title' => 'Núi Bà Đen, Tây Ninh',
                'excerpt' => '"Nóc nhà Nam Bộ" với hệ thống cáp treo hiện đại và quần thể tâm linh trên đỉnh núi.',
                'content' => 'Núi Bà Đen thu hút du khách bởi cảnh quan hùng vĩ và các công trình kiến trúc Phật giáo ấn tượng. Đây là điểm đến lý tưởng cho cả du lịch tâm linh và săn mây, ngắm cảnh.',
                'cover_image' => 'https://images.pexels.com/photos/13697976/pexels-photo-13697976.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Tây Ninh',
                'province' => 'Tây Ninh',
                'featured' => false,
            ],
            [
                'title' => 'Rừng tràm Trà Sư, An Giang',
                'excerpt' => 'Khám phá hệ sinh thái đất ngập nước đặc trưng của miền Tây bằng xuồng máy và ghe chèo.',
                'content' => 'Rừng tràm Trà Sư là một thảm thực vật xanh mướt với lớp bèo tây phủ kín mặt nước. Du khách sẽ len lỏi qua các con rạch nhỏ, quan sát nhiều loài chim cò và tận hưởng không khí trong lành.',
                'cover_image' => 'https://images.pexels.com/photos/13206689/pexels-photo-13206689.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Tịnh Biên',
                'province' => 'An Giang',
                'featured' => false,
            ],
            [
                'title' => 'Mũi Cà Mau',
                'excerpt' => 'Điểm cực Nam của Tổ quốc, nơi duy nhất trên đất liền có thể ngắm mặt trời mọc ở biển Đông và lặn ở biển Tây.',
                'content' => 'Đến Mũi Cà Mau, du khách sẽ được check-in tại cột mốc tọa độ quốc gia và biểu tượng con tàu. Đây là một trải nghiệm đầy ý nghĩa và tự hào về chủ quyền lãnh thổ Việt Nam.',
                'cover_image' => 'https://images.pexels.com/photos/1078981/pexels-photo-1078981.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Ngọc Hiển',
                'province' => 'Cà Mau',
                'featured' => false,
            ],
            [
                'title' => 'Thành phố Vũng Tàu',
                'excerpt' => 'Thành phố biển gần Sài Gòn với Bãi Trước, Bãi Sau và Tượng Chúa Kitô Vua.',
                'content' => 'Vũng Tàu là điểm đến cuối tuần quen thuộc của người dân miền Nam. Ngoài tắm biển, du khách có thể leo lên Tượng Chúa Kitô Vua để ngắm toàn cảnh thành phố hoặc thưởng thức hải sản tươi ngon.',
                'cover_image' => 'https://images.pexels.com/photos/237272/pexels-photo-237272.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'gallery' => [],
                'location' => 'Vũng Tàu',
                'province' => 'Bà Rịa - Vũng Tàu',
                'featured' => false,
            ],
        ];

        foreach ($destinations as $item) {
            // Generate unique slug
            $slug = Str::slug($item['title']);
            $count = Destination::where('slug', 'LIKE', "{$slug}%")->count();
            if ($count > 0) {
                $slug = "{$slug}-" . ($count + 1);
            }

            Destination::create([
                ...$item,
                'slug' => $slug,
                'published_at' => Carbon::now()->subDays(rand(1, 100)),
            ]);
        }
    }
}

