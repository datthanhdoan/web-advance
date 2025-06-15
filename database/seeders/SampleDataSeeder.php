<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo users mẫu
        $users = [
            [
                'name' => 'Nguyễn Văn An',
                'email' => 'nguyenvanan@blog.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Trần Thị Bình',
                'email' => 'tranthibinh@blog.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Lê Minh Cường',
                'email' => 'leminhcuong@blog.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Phạm Thu Dung',
                'email' => 'phamthudung@blog.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Hoàng Văn Em',
                'email' => 'hoangvanem@blog.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Đỗ Thị Phương',
                'email' => 'dothiphuong@blog.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Lấy tất cả users (bao gồm cả admin đã tạo trước đó)
        $allUsers = User::all();
        $categories = Category::all();
        $tags = Tag::all();

        // Dữ liệu bài viết mẫu
        $samplePosts = [
            [
                'title' => 'Hướng dẫn học Laravel từ cơ bản đến nâng cao',
                'excerpt' => 'Laravel là một framework PHP mạnh mẽ và phổ biến. Bài viết này sẽ hướng dẫn bạn từ những bước đầu tiên.',
                'content' => '<h2>Giới thiệu về Laravel</h2>
                <p>Laravel là một framework PHP mã nguồn mở, được phát triển bởi Taylor Otwell vào năm 2011. Laravel được xây dựng dựa trên các nguyên tắc của Symfony framework và tuân theo mô hình kiến trúc MVC (Model-View-Controller).</p>
                
                <h3>Tại sao nên chọn Laravel?</h3>
                <ul>
                <li><strong>Cú pháp đơn giản và dễ hiểu:</strong> Laravel có cú pháp rất gần gũi với ngôn ngữ tự nhiên</li>
                <li><strong>Ecosystem phong phú:</strong> Có rất nhiều package và tool hỗ trợ</li>
                <li><strong>Bảo mật tốt:</strong> Laravel cung cấp nhiều tính năng bảo mật built-in</li>
                <li><strong>Cộng đồng lớn:</strong> Có cộng đồng developer rất tích cực</li>
                </ul>
                
                <h3>Cài đặt Laravel</h3>
                <p>Để cài đặt Laravel, bạn cần có PHP >= 8.1 và Composer. Chạy lệnh sau:</p>
                <pre><code>composer create-project laravel/laravel my-project</code></pre>
                
                <h3>Cấu trúc thư mục</h3>
                <p>Laravel có cấu trúc thư mục rất logic và dễ hiểu:</p>
                <ul>
                <li><code>app/</code> - Chứa code chính của ứng dụng</li>
                <li><code>config/</code> - Các file cấu hình</li>
                <li><code>database/</code> - Migration, seeder, factory</li>
                <li><code>resources/</code> - Views, assets</li>
                <li><code>routes/</code> - Định nghĩa routes</li>
                </ul>
                
                <p>Trong các bài tiếp theo, chúng ta sẽ tìm hiểu sâu hơn về từng thành phần của Laravel.</p>',
                'category' => 'Lập trình',
                'tags' => ['Laravel', 'PHP', 'Web Development'],
                'views' => rand(100, 500),
            ],
            [
                'title' => '10 mẹo nấu ăn giúp bạn tiết kiệm thời gian',
                'excerpt' => 'Những mẹo nấu ăn thông minh giúp bạn chuẩn bị bữa ăn ngon và nhanh chóng cho gia đình.',
                'content' => '<h2>Mẹo nấu ăn thông minh</h2>
                <p>Nấu ăn không chỉ là nghệ thuật mà còn là khoa học. Dưới đây là 10 mẹo giúp bạn nấu ăn hiệu quả hơn:</p>
                
                <h3>1. Chuẩn bị nguyên liệu trước</h3>
                <p>Hãy rửa, thái, ướp tất cả nguyên liệu trước khi bắt đầu nấu. Điều này giúp bạn không bị vội vàng khi đang nấu.</p>
                
                <h3>2. Sử dụng nồi áp suất</h3>
                <p>Nồi áp suất giúp giảm thời gian nấu các món hầm, niệu từ 2-3 tiếng xuống còn 30-45 phút.</p>
                
                <h3>3. Nấu nhiều và bảo quản</h3>
                <p>Nấu một lần nhiều phần ăn, sau đó chia nhỏ và đông lạnh. Khi cần chỉ việc rã đông và hâm nóng.</p>
                
                <h3>4. Sử dụng gia vị khô</h3>
                <p>Gia vị khô bảo quản được lâu hơn và tạo hương vị đậm đà cho món ăn.</p>
                
                <h3>5. Học cách thái nhanh</h3>
                <p>Đầu tư thời gian học kỹ thuật thái rau củ sẽ giúp bạn tiết kiệm rất nhiều thời gian.</p>
                
                <p>Áp dụng những mẹo này, bạn sẽ thấy việc nấu ăn trở nên dễ dàng và thú vị hơn nhiều!</p>',
                'category' => 'Ẩm thực',
                'tags' => ['Nấu ăn', 'Mẹo hay', 'Gia đình'],
                'views' => rand(200, 800),
            ],
            [
                'title' => 'Du lịch Đà Lạt - Kinh nghiệm từ A đến Z',
                'excerpt' => 'Hướng dẫn chi tiết về du lịch Đà Lạt, từ lịch trình, địa điểm tham quan đến ẩm thực đặc sản.',
                'content' => '<h2>Đà Lạt - Thành phố ngàn hoa</h2>
                <p>Đà Lạt là một trong những điểm du lịch hấp dẫn nhất Việt Nam với khí hậu mát mẻ quanh năm và cảnh quan thiên nhiên tuyệt đẹp.</p>
                
                <h3>Thời điểm tốt nhất để đi</h3>
                <p>Đà Lạt đẹp quanh năm, nhưng thời điểm lý tưởng nhất là:</p>
                <ul>
                <li><strong>Tháng 12-2:</strong> Mùa hoa mimosa, thời tiết khô ráo</li>
                <li><strong>Tháng 3-5:</strong> Mùa hoa anh đào, thời tiết ấm áp</li>
                <li><strong>Tháng 10-11:</strong> Mùa hoa dã quỳ, ít mưa</li>
                </ul>
                
                <h3>Địa điểm không thể bỏ qua</h3>
                <h4>1. Hồ Xuân Hương</h4>
                <p>Trung tâm của thành phố, nơi lý tưởng để dạo bộ và ngắm cảnh.</p>
                
                <h4>2. Thác Elephant</h4>
                <p>Thác nước hùng vĩ cách trung tâm khoảng 30km.</p>
                
                <h4>3. Đồi Cù</h4>
                <p>Nơi ngắm hoàng hôn đẹp nhất Đà Lạt.</p>
                
                <h4>4. Ga Đà Lạt</h4>
                <p>Ga tàu cổ với kiến trúc Pháp độc đáo.</p>
                
                <h3>Ẩm thực đặc sản</h3>
                <ul>
                <li>Bánh tráng nướng</li>
                <li>Nem nướng Đà Lạt</li>
                <li>Bánh căn</li>
                <li>Sữa đậu nành nóng</li>
                <li>Bánh mì xíu mại</li>
                </ul>
                
                <h3>Lưu ý khi đi</h3>
                <p>- Mang theo áo ấm vì Đà Lạt mát quanh năm<br>
                - Đặt phòng trước, đặc biệt vào cuối tuần và lễ tết<br>
                - Thuê xe máy để di chuyển linh hoạt</p>',
                'category' => 'Du lịch',
                'tags' => ['Đà Lạt', 'Du lịch', 'Kinh nghiệm'],
                'views' => rand(300, 1000),
            ],
            [
                'title' => 'Cách chăm sóc cây cảnh trong nhà hiệu quả',
                'excerpt' => 'Hướng dẫn chi tiết cách chăm sóc các loại cây cảnh phổ biến để có không gian xanh trong nhà.',
                'content' => '<h2>Tạo không gian xanh trong nhà</h2>
                <p>Cây cảnh không chỉ làm đẹp không gian sống mà còn giúp thanh lọc không khí và mang lại cảm giác thư giãn.</p>
                
                <h3>Những loại cây dễ trồng cho người mới bắt đầu</h3>
                
                <h4>1. Cây Trầu Bà</h4>
                <p>Cây rất dễ chăm sóc, chịu được ánh sáng yếu và không cần tưới nước thường xuyên.</p>
                <ul>
                <li>Tưới nước: 1-2 lần/tuần</li>
                <li>Ánh sáng: Ánh sáng gián tiếp</li>
                <li>Nhiệt độ: 18-24°C</li>
                </ul>
                
                <h4>2. Cây Lưỡi Hổ</h4>
                <p>Cây có khả năng thanh lọc không khí tốt, đặc biệt hiệu quả vào ban đêm.</p>
                <ul>
                <li>Tưới nước: 2-3 tuần/lần</li>
                <li>Ánh sáng: Chịu được cả ánh sáng mạnh và yếu</li>
                <li>Đất: Cần thoát nước tốt</li>
                </ul>
                
                <h4>3. Cây Kim Tiền</h4>
                <p>Biểu tượng của may mắn và thịnh vượng, rất dễ chăm sóc.</p>
                <ul>
                <li>Tưới nước: Khi đất khô</li>
                <li>Ánh sáng: Ánh sáng gián tiếp</li>
                <li>Phân bón: 1 tháng/lần</li>
                </ul>
                
                <h3>Nguyên tắc chăm sóc cơ bản</h3>
                
                <h4>Tưới nước đúng cách</h4>
                <p>- Kiểm tra độ ẩm đất bằng cách nhúng ngón tay xuống đất 2-3cm<br>
                - Tưới nước vào buổi sáng sớm<br>
                - Tránh tưới nước lên lá</p>
                
                <h4>Ánh sáng phù hợp</h4>
                <p>- Đặt cây gần cửa sổ nhưng tránh ánh nắng trực tiếp<br>
                - Xoay chậu cây định kỳ để cây phát triển đều<br>
                - Sử dụng đèn LED nếu thiếu ánh sáng tự nhiên</p>
                
                <h4>Phân bón và chăm sóc</h4>
                <p>- Bón phân loãng 1 tháng/lần vào mùa sinh trưởng<br>
                - Cắt tỉa lá già, lá vàng thường xuyên<br>
                - Thay chậu khi cây lớn</p>
                
                <p>Với những kiến thức cơ bản này, bạn có thể tạo ra một khu vườn mini tuyệt đẹp trong nhà!</p>',
                'category' => 'Làm vườn',
                'tags' => ['Cây cảnh', 'Làm vườn', 'Trang trí nhà'],
                'views' => rand(150, 600),
            ],
            [
                'title' => 'Tài chính cá nhân: 7 thói quen giúp bạn giàu có',
                'excerpt' => 'Những thói quen tài chính thông minh giúp bạn xây dựng tài sản và đạt được tự do tài chính.',
                'content' => '<h2>Xây dựng thói quen tài chính tốt</h2>
                <p>Tự do tài chính không đến từ thu nhập cao mà từ cách quản lý tiền bạc thông minh. Dưới đây là 7 thói quen quan trọng:</p>
                
                <h3>1. Lập ngân sách chi tiết</h3>
                <p>Theo dõi mọi khoản thu chi để biết tiền đi đâu. Sử dụng quy tắc 50/30/20:</p>
                <ul>
                <li>50% cho nhu cầu thiết yếu</li>
                <li>30% cho giải trí</li>
                <li>20% cho tiết kiệm và đầu tư</li>
                </ul>
                
                <h3>2. Tiết kiệm trước, chi tiêu sau</h3>
                <p>Ngay khi nhận lương, hãy chuyển một phần vào tài khoản tiết kiệm trước khi chi tiêu.</p>
                
                <h3>3. Tạo quỹ khẩn cấp</h3>
                <p>Duy trì quỹ khẩn cấp tương đương 3-6 tháng chi phí sinh hoạt để đối phó với những tình huống bất ngờ.</p>
                
                <h3>4. Đầu tư sớm và đều đặn</h3>
                <p>Bắt đầu đầu tư càng sớm càng tốt để tận dụng sức mạnh của lãi kép:</p>
                <ul>
                <li>Cổ phiếu cho tăng trưởng dài hạn</li>
                <li>Trái phiếu cho thu nhập ổn định</li>
                <li>Quỹ đầu tư cho đa dạng hóa</li>
                </ul>
                
                <h3>5. Tránh nợ xấu</h3>
                <p>Phân biệt nợ tốt (mua nhà, đầu tư) và nợ xấu (thẻ tín dụng, vay tiêu dùng). Ưu tiên trả hết nợ xấu.</p>
                
                <h3>6. Tăng thu nhập</h3>
                <p>Không chỉ tiết kiệm mà còn tìm cách tăng thu nhập:</p>
                <ul>
                <li>Nâng cao kỹ năng nghề nghiệp</li>
                <li>Tìm công việc phụ</li>
                <li>Tạo thu nhập thụ động</li>
                </ul>
                
                <h3>7. Học hỏi liên tục</h3>
                <p>Đọc sách, tham gia khóa học về tài chính để nâng cao kiến thức đầu tư và quản lý tiền bạc.</p>
                
                <h3>Kết luận</h3>
                <p>Tự do tài chính là một hành trình dài, không phải đích đến. Hãy kiên nhẫn và duy trì những thói quen tốt này!</p>',
                'category' => 'Tài chính',
                'tags' => ['Tài chính cá nhân', 'Đầu tư', 'Tiết kiệm'],
                'views' => rand(400, 1200),
            ],
            [
                'title' => 'Yoga cho người mới bắt đầu - 10 tư thế cơ bản',
                'excerpt' => 'Hướng dẫn chi tiết 10 tư thế yoga cơ bản giúp bạn bắt đầu hành trình rèn luyện sức khỏe.',
                'content' => '<h2>Bắt đầu hành trình Yoga</h2>
                <p>Yoga không chỉ giúp cải thiện sức khỏe thể chất mà còn mang lại sự bình an cho tâm hồn. Dưới đây là 10 tư thế cơ bản:</p>
                
                <h3>1. Tư thế núi (Mountain Pose)</h3>
                <p>Tư thế cơ bản nhất, giúp cải thiện tư thế và tăng cường sự tập trung.</p>
                <ul>
                <li>Đứng thẳng, hai chân song song</li>
                <li>Tay thả lỏng hai bên</li>
                <li>Thở sâu và giữ 30 giây</li>
                </ul>
                
                <h3>2. Tư thế con chó úp mặt (Downward Dog)</h3>
                <p>Giúp kéo giãn toàn thân và tăng cường sức mạnh.</p>
                <ul>
                <li>Bắt đầu từ tư thế bò</li>
                <li>Nâng hông lên cao, tạo hình tam giác</li>
                <li>Giữ 30-60 giây</li>
                </ul>
                
                <h3>3. Tư thế chiến binh I (Warrior I)</h3>
                <p>Tăng cường sức mạnh chân và cải thiện thể lực.</p>
                <ul>
                <li>Chân trước gập 90 độ</li>
                <li>Chân sau duỗi thẳng</li>
                <li>Tay vươn lên trời</li>
                </ul>
                
                <h3>4. Tư thế tam giác (Triangle Pose)</h3>
                <p>Kéo giãn cơ bên hông và tăng cường độ linh hoạt.</p>
                
                <h3>5. Tư thế cây (Tree Pose)</h3>
                <p>Cải thiện thể lực và sự tập trung.</p>
                
                <h3>6. Tư thế cầu (Bridge Pose)</h3>
                <p>Tăng cường cơ lưng và mở rộng ngực.</p>
                
                <h3>7. Tư thế em bé (Child Pose)</h3>
                <p>Tư thế nghỉ ngơi, giúp thư giãn.</p>
                
                <h3>8. Tư thế xoắn ngồi (Seated Twist)</h3>
                <p>Cải thiện tiêu hóa và linh hoạt cột sống.</p>
                
                <h3>9. Tư thế cái kéo (Scissors Pose)</h3>
                <p>Tăng cường cơ bụng và cải thiện thể lực.</p>
                
                <h3>10. Tư thế xác chết (Corpse Pose)</h3>
                <p>Tư thế thư giãn cuối buổi tập, giúp cơ thể hồi phục.</p>
                
                <h3>Lời khuyên cho người mới</h3>
                <ul>
                <li>Bắt đầu từ từ, không ép buộc cơ thể</li>
                <li>Tập 15-20 phút mỗi ngày</li>
                <li>Tập trung vào hơi thở</li>
                <li>Sử dụng thảm yoga chất lượng tốt</li>
                </ul>',
                'category' => 'Sức khỏe',
                'tags' => ['Yoga', 'Sức khỏe', 'Thể dục'],
                'views' => rand(250, 700),
            ],
            [
                'title' => 'Thiết kế UI/UX: Nguyên tắc vàng cho người mới',
                'excerpt' => 'Những nguyên tắc cơ bản trong thiết kế UI/UX giúp tạo ra sản phẩm thân thiện với người dùng.',
                'content' => '<h2>Nguyên tắc thiết kế UI/UX</h2>
                <p>Thiết kế UI/UX tốt là chìa khóa thành công của mọi sản phẩm số. Dưới đây là những nguyên tắc cơ bản:</p>
                
                <h3>1. Nguyên tắc đơn giản (Simplicity)</h3>
                <p>Giao diện càng đơn giản càng dễ sử dụng. Loại bỏ những yếu tố không cần thiết.</p>
                <ul>
                <li>Sử dụng white space hiệu quả</li>
                <li>Hạn chế số lượng màu sắc</li>
                <li>Tập trung vào chức năng chính</li>
                </ul>
                
                <h3>2. Tính nhất quán (Consistency)</h3>
                <p>Duy trì sự thống nhất trong toàn bộ sản phẩm:</p>
                <ul>
                <li>Màu sắc và typography</li>
                <li>Cách thức tương tác</li>
                <li>Vị trí các element</li>
                </ul>
                
                <h3>3. Phân cấp thông tin (Hierarchy)</h3>
                <p>Sắp xếp thông tin theo mức độ quan trọng:</p>
                <ul>
                <li>Sử dụng kích thước font khác nhau</li>
                <li>Áp dụng màu sắc để làm nổi bật</li>
                <li>Sử dụng khoảng trắng để phân nhóm</li>
                </ul>
                
                <h3>4. Khả năng sử dụng (Usability)</h3>
                <p>Đảm bảo người dùng có thể sử dụng dễ dàng:</p>
                <ul>
                <li>Navigation rõ ràng</li>
                <li>Feedback tức thì</li>
                <li>Error handling tốt</li>
                </ul>
                
                <h3>5. Accessibility</h3>
                <p>Thiết kế cho tất cả mọi người:</p>
                <ul>
                <li>Contrast màu sắc phù hợp</li>
                <li>Kích thước text đủ lớn</li>
                <li>Hỗ trợ keyboard navigation</li>
                </ul>
                
                <h3>6. Mobile-first</h3>
                <p>Thiết kế cho mobile trước, sau đó mở rộng ra desktop.</p>
                
                <h3>7. Performance</h3>
                <p>Tối ưu hóa tốc độ tải trang và phản hồi.</p>
                
                <h3>Tools hữu ích</h3>
                <ul>
                <li><strong>Figma:</strong> Thiết kế và prototype</li>
                <li><strong>Adobe XD:</strong> Thiết kế UI/UX</li>
                <li><strong>Sketch:</strong> Thiết kế interface</li>
                <li><strong>InVision:</strong> Prototype và collaboration</li>
                </ul>
                
                <h3>Quy trình thiết kế</h3>
                <ol>
                <li>Research và phân tích user</li>
                <li>Tạo user persona</li>
                <li>Wireframe và prototype</li>
                <li>Visual design</li>
                <li>Testing và iteration</li>
                </ol>',
                'category' => 'Thiết kế',
                'tags' => ['UI/UX', 'Thiết kế', 'Web Design'],
                'views' => rand(300, 900),
            ],
            [
                'title' => 'Cách viết CV xin việc ấn tượng năm 2024',
                'excerpt' => 'Hướng dẫn chi tiết cách viết CV chuyên nghiệp để gây ấn tượng với nhà tuyển dụng.',
                'content' => '<h2>Viết CV hiệu quả</h2>
                <p>CV là ấn tượng đầu tiên của bạn với nhà tuyển dụng. Một CV tốt có thể mở ra cơ hội nghề nghiệp mới.</p>
                
                <h3>Cấu trúc CV chuẩn</h3>
                
                <h4>1. Thông tin cá nhân</h4>
                <ul>
                <li>Họ tên đầy đủ</li>
                <li>Số điện thoại, email</li>
                <li>Địa chỉ (không cần quá chi tiết)</li>
                <li>LinkedIn profile</li>
                </ul>
                
                <h4>2. Mục tiêu nghề nghiệp</h4>
                <p>Viết 2-3 câu ngắn gọn về mục tiêu và giá trị bạn mang lại.</p>
                
                <h4>3. Kinh nghiệm làm việc</h4>
                <p>Sắp xếp theo thứ tự thời gian ngược (mới nhất trước):</p>
                <ul>
                <li>Tên công ty và vị trí</li>
                <li>Thời gian làm việc</li>
                <li>Mô tả công việc và thành tích</li>
                </ul>
                
                <h4>4. Học vấn</h4>
                <ul>
                <li>Tên trường và chuyên ngành</li>
                <li>Thời gian học</li>
                <li>GPA (nếu cao)</li>
                <li>Các thành tích nổi bật</li>
                </ul>
                
                <h4>5. Kỹ năng</h4>
                <p>Chia thành các nhóm:</p>
                <ul>
                <li>Kỹ năng chuyên môn</li>
                <li>Kỹ năng mềm</li>
                <li>Ngôn ngữ</li>
                <li>Công cụ/phần mềm</li>
                </ul>
                
                <h3>Những điều cần tránh</h3>
                <ul>
                <li>CV quá dài (tối đa 2 trang)</li>
                <li>Sai chính tả, ngữ pháp</li>
                <li>Thông tin không liên quan</li>
                <li>Font chữ khó đọc</li>
                <li>Ảnh không chuyên nghiệp</li>
                </ul>
                
                <h3>Tips để CV nổi bật</h3>
                <ul>
                <li>Sử dụng từ khóa từ job description</li>
                <li>Lượng hóa thành tích bằng số liệu</li>
                <li>Tùy chỉnh CV cho từng vị trí</li>
                <li>Sử dụng action verbs</li>
                <li>Kiểm tra kỹ trước khi gửi</li>
                </ul>
                
                <h3>CV cho từng ngành</h3>
                
                <h4>IT/Tech</h4>
                <p>Nhấn mạnh technical skills, projects, GitHub profile.</p>
                
                <h4>Marketing</h4>
                <p>Tập trung vào campaigns, metrics, creative projects.</p>
                
                <h4>Sales</h4>
                <p>Highlight số liệu bán hàng, target achievement.</p>
                
                <h3>Cover Letter</h3>
                <p>Đừng quên viết cover letter để giải thích tại sao bạn phù hợp với vị trí này.</p>',
                'category' => 'Nghề nghiệp',
                'tags' => ['CV', 'Tìm việc', 'Nghề nghiệp'],
                'views' => rand(500, 1500),
            ],
        ];

        // Tạo posts cho từng user
        foreach ($samplePosts as $index => $postData) {
            $user = $allUsers->random();
            $category = $categories->where('name', $postData['category'])->first();
            
            $post = Post::create([
                'title' => $postData['title'],
                'slug' => \Str::slug($postData['title']),
                'excerpt' => $postData['excerpt'],
                'content' => $postData['content'],
                'user_id' => $user->id,
                'category_id' => $category ? $category->id : null,
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => $postData['views'],
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 5)),
            ]);

            // Attach tags
            if (!empty($postData['tags'])) {
                $postTags = [];
                foreach ($postData['tags'] as $tagName) {
                    $tag = $tags->where('name', $tagName)->first();
                    if ($tag) {
                        $postTags[] = $tag->id;
                    }
                }
                if (!empty($postTags)) {
                    $post->tags()->attach($postTags);
                }
            }
        }

        // Tạo comments mẫu
        $posts = Post::all();
        $commentTexts = [
            'Bài viết rất hay và bổ ích! Cảm ơn bạn đã chia sẻ.',
            'Thông tin rất chi tiết và dễ hiểu. Tôi đã học được nhiều điều mới.',
            'Cảm ơn bạn vì bài viết tuyệt vời này. Tôi sẽ áp dụng ngay!',
            'Rất hữu ích! Bạn có thể chia sẻ thêm về chủ đề này không?',
            'Bài viết được viết rất chuyên nghiệp. Tôi rất thích!',
            'Kinh nghiệm quý báu! Cảm ơn bạn đã chia sẻ.',
            'Thật tuyệt vời! Tôi đã bookmark để đọc lại.',
            'Bài viết giải đáp được nhiều thắc mắc của tôi.',
            'Cách trình bày rất logic và dễ theo dõi.',
            'Tôi sẽ recommend bài viết này cho bạn bè!',
        ];

        foreach ($posts as $post) {
            $numComments = rand(2, 8);
            for ($i = 0; $i < $numComments; $i++) {
                $commenter = $allUsers->random();
                Comment::create([
                    'content' => $commentTexts[array_rand($commentTexts)],
                    'user_id' => $commenter->id,
                    'post_id' => $post->id,
                    'is_approved' => true,
                    'created_at' => now()->subDays(rand(0, 15)),
                ]);
            }
        }

        $this->command->info('Đã tạo thành công dữ liệu mẫu!');
        $this->command->info('- ' . count($users) . ' users mới');
        $this->command->info('- ' . count($samplePosts) . ' bài viết');
        $this->command->info('- Nhiều comments cho các bài viết');
    }
}
