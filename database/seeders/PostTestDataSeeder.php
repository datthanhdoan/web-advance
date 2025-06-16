<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;

class PostTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy users, categories và tags có sẵn
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::all();

        if ($users->isEmpty() || $categories->isEmpty() || $tags->isEmpty()) {
            $this->command->error('Vui lòng chạy CategorySeeder, TagSeeder và tạo users trước!');
            return;
        }

        // Dữ liệu posts test đa dạng
        $testPosts = [
            // Post có đầy đủ thông tin
            [
                'title' => 'Hướng dẫn xây dựng API RESTful với Laravel 10',
                'excerpt' => 'Tìm hiểu cách xây dựng API RESTful hoàn chỉnh với Laravel 10, bao gồm authentication, validation và testing.',
                'content' => $this->getFullContent('api_laravel'),
                'status' => 'published',
                'published_at' => now()->subDays(1),
                'views' => rand(500, 1500),
                'category' => 'Lập trình',
                'tags' => ['Laravel', 'API', 'PHP', 'Backend'],
            ],
            
            // Post draft (chưa publish)
            [
                'title' => 'Xu hướng thiết kế web 2024',
                'excerpt' => 'Khám phá những xu hướng thiết kế web mới nhất năm 2024 từ minimalism đến dark mode.',
                'content' => $this->getFullContent('web_design_2024'),
                'status' => 'draft',
                'published_at' => null,
                'views' => 0,
                'category' => 'Thiết kế',
                'tags' => ['Web Design', 'UI/UX', 'Trends'],
            ],
            
            // Post không có excerpt (sẽ auto generate)
            [
                'title' => 'Cách tối ưu hóa hiệu suất website',
                'excerpt' => null,
                'content' => $this->getFullContent('website_optimization'),
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'views' => rand(200, 800),
                'category' => 'Công nghệ',
                'tags' => ['Performance', 'SEO', 'Web Development'],
            ],
            
            // Post có nội dung ngắn
            [
                'title' => 'Tips học lập trình hiệu quả',
                'excerpt' => 'Những mẹo nhỏ giúp bạn học lập trình hiệu quả hơn.',
                'content' => '<p>Học lập trình cần kiên trì và phương pháp đúng. Hãy thực hành mỗi ngày và đừng ngại hỏi khi gặp khó khăn.</p><p>Tham gia cộng đồng lập trình viên để học hỏi kinh nghiệm từ những người đi trước.</p>',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'views' => rand(100, 400),
                'category' => 'Lập trình',
                'tags' => ['Programming', 'Tips'],
            ],
            
            // Post có nội dung dài
            [
                'title' => 'Hướng dẫn chi tiết về Docker cho developers',
                'excerpt' => 'Tìm hiểu Docker từ cơ bản đến nâng cao, từ cài đặt đến triển khai ứng dụng production.',
                'content' => $this->getFullContent('docker_guide'),
                'status' => 'published',
                'published_at' => now()->subWeek(),
                'views' => rand(800, 2000),
                'category' => 'DevOps',
                'tags' => ['Docker', 'DevOps', 'Containerization'],
            ],
            
            // Post về du lịch
            [
                'title' => 'Khám phá vẻ đẹp Hội An về đêm',
                'excerpt' => 'Hội An về đêm có một vẻ đẹp rất riêng với những chiếc đèn lồng lung linh.',
                'content' => $this->getFullContent('hoi_an_night'),
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'views' => rand(300, 900),
                'category' => 'Du lịch',
                'tags' => ['Hội An', 'Du lịch', 'Việt Nam'],
            ],
            
            // Post về ẩm thực
            [
                'title' => 'Cách làm bánh mì Việt Nam chuẩn vị',
                'excerpt' => 'Hướng dẫn làm bánh mì Việt Nam từ làm bánh đến pha chế nước mắm chua ngọt.',
                'content' => $this->getFullContent('banh_mi_recipe'),
                'status' => 'published',
                'published_at' => now()->subDays(4),
                'views' => rand(400, 1200),
                'category' => 'Ẩm thực',
                'tags' => ['Bánh mì', 'Món Việt', 'Nấu ăn'],
            ],
            
            // Post về sức khỏe
            [
                'title' => 'Tập yoga tại nhà cho người mới bắt đầu',
                'excerpt' => 'Những bài tập yoga cơ bản có thể thực hiện tại nhà mà không cần dụng cụ.',
                'content' => $this->getFullContent('yoga_beginner'),
                'status' => 'published',
                'published_at' => now()->subDays(6),
                'views' => rand(250, 700),
                'category' => 'Sức khỏe',
                'tags' => ['Yoga', 'Sức khỏe', 'Thể dục'],
            ],
            
            // Post có views cao
            [
                'title' => 'Top 10 framework JavaScript phổ biến nhất 2024',
                'excerpt' => 'Danh sách các framework JavaScript được sử dụng nhiều nhất trong năm 2024.',
                'content' => $this->getFullContent('js_frameworks'),
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'views' => rand(2000, 5000),
                'category' => 'Lập trình',
                'tags' => ['JavaScript', 'Framework', 'Frontend'],
            ],
            
            // Post mới nhất
            [
                'title' => 'Tin tức công nghệ mới nhất tuần này',
                'excerpt' => 'Cập nhật những tin tức công nghệ hot nhất trong tuần qua.',
                'content' => $this->getFullContent('tech_news'),
                'status' => 'published',
                'published_at' => now()->subHours(2),
                'views' => rand(50, 200),
                'category' => 'Công nghệ',
                'tags' => ['Tech News', 'Technology'],
            ],
        ];

        foreach ($testPosts as $postData) {
            // Tìm category
            $category = $categories->where('name', $postData['category'])->first();
            if (!$category) {
                $category = $categories->random();
            }

            // Tạo post
            $post = Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'excerpt' => $postData['excerpt'],
                'content' => $postData['content'],
                'status' => $postData['status'],
                'published_at' => $postData['published_at'],
                'views' => $postData['views'],
                'category_id' => $category->id,
                'user_id' => $users->random()->id,
            ]);

            // Attach tags
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

        $this->command->info('Đã tạo ' . count($testPosts) . ' posts test thành công!');
    }

    private function getFullContent($type)
    {
        $contents = [
            'api_laravel' => '<h2>Giới thiệu về API RESTful</h2>
                <p>API RESTful là một kiểu kiến trúc phần mềm được sử dụng rộng rãi để xây dựng các web service. REST (Representational State Transfer) định nghĩa một tập hợp các ràng buộc kiến trúc.</p>
                
                <h3>Các HTTP Methods chính</h3>
                <ul>
                <li><strong>GET:</strong> Lấy dữ liệu</li>
                <li><strong>POST:</strong> Tạo mới dữ liệu</li>
                <li><strong>PUT:</strong> Cập nhật toàn bộ</li>
                <li><strong>PATCH:</strong> Cập nhật một phần</li>
                <li><strong>DELETE:</strong> Xóa dữ liệu</li>
                </ul>
                
                <h3>Cài đặt Laravel Sanctum</h3>
                <pre><code>composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate</code></pre>
                
                <h3>Tạo API Controller</h3>
                <pre><code>php artisan make:controller Api/PostController --api</code></pre>
                
                <p>Trong controller, chúng ta sẽ implement các method CRUD cơ bản và trả về JSON response.</p>',

            'web_design_2024' => '<h2>Xu hướng thiết kế web 2024</h2>
                <p>Năm 2024 mang đến nhiều xu hướng thiết kế web mới thú vị, từ minimalism đến các hiệu ứng tương tác phức tạp.</p>
                
                <h3>1. Dark Mode</h3>
                <p>Dark mode không chỉ là trend mà đã trở thành standard. Nó giúp giảm mỏi mắt và tiết kiệm pin.</p>
                
                <h3>2. Micro-interactions</h3>
                <p>Các tương tác nhỏ giúp tăng trải nghiệm người dùng và tạo cảm giác responsive.</p>
                
                <h3>3. Typography lớn và đậm</h3>
                <p>Typography trở thành yếu tố thiết kế chính, không chỉ là phương tiện truyền tải thông tin.</p>',

            'website_optimization' => '<h2>Tối ưu hóa hiệu suất website</h2>
                <p>Hiệu suất website ảnh hưởng trực tiếp đến trải nghiệm người dùng và SEO ranking. Dưới đây là các kỹ thuật tối ưu hóa hiệu quả.</p>
                
                <h3>Tối ưu hóa hình ảnh</h3>
                <ul>
                <li>Sử dụng format WebP</li>
                <li>Lazy loading cho images</li>
                <li>Responsive images với srcset</li>
                <li>Compress images trước khi upload</li>
                </ul>
                
                <h3>Minify CSS và JavaScript</h3>
                <p>Loại bỏ whitespace, comments và code không cần thiết để giảm kích thước file.</p>
                
                <h3>Sử dụng CDN</h3>
                <p>Content Delivery Network giúp phân phối nội dung từ server gần người dùng nhất.</p>
                
                <h3>Caching Strategy</h3>
                <p>Implement browser caching, server-side caching và database query caching.</p>',

            'docker_guide' => '<h2>Docker cho Developers</h2>
                <p>Docker là platform containerization giúp đóng gói ứng dụng và dependencies thành containers có thể chạy ở bất kỳ đâu.</p>
                
                <h3>Cài đặt Docker</h3>
                <p>Download Docker Desktop từ trang chủ và cài đặt theo hướng dẫn cho từng OS.</p>
                
                <h3>Dockerfile cơ bản</h3>
                <pre><code>FROM node:16-alpine
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
EXPOSE 3000
CMD ["npm", "start"]</code></pre>
                
                <h3>Docker Compose</h3>
                <p>Quản lý multi-container applications với docker-compose.yml:</p>
                <pre><code>version: "3.8"
services:
  web:
    build: .
    ports:
      - "3000:3000"
  db:
    image: postgres:13
    environment:
      POSTGRES_PASSWORD: password</code></pre>
                
                <h3>Best Practices</h3>
                <ul>
                <li>Sử dụng multi-stage builds</li>
                <li>Minimize layer count</li>
                <li>Use .dockerignore</li>
                <li>Run as non-root user</li>
                </ul>',

            'hoi_an_night' => '<h2>Hội An về đêm - Vẻ đẹp cổ kính</h2>
                <p>Khi màn đêm buông xuống, Hội An khoác lên mình một vẻ đẹp huyền ảo với hàng nghìn chiếc đèn lồng rực rỡ sắc màu.</p>
                
                <h3>Phố cổ Hội An</h3>
                <p>Dạo bước trên những con đường lát đá cổ kính, bạn sẽ cảm nhận được không khí yên bình và thơ mộng của phố cổ.</p>
                
                <h3>Chùa Cầu Nhật Bản</h3>
                <p>Biểu tượng của Hội An trở nên lung linh hơn dưới ánh đèn vàng ấm áp.</p>
                
                <h3>Sông Hoài</h3>
                <p>Thả đèn hoa đăng trên sông Hoài là trải nghiệm không thể bỏ qua khi đến Hội An.</p>
                
                <h3>Ẩm thực đường phố</h3>
                <p>Thưởng thức cao lầu, bánh mì Phượng, chè bắp hay cơm gà Hội An tại các quán ven đường.</p>',

            'banh_mi_recipe' => '<h2>Cách làm bánh mì Việt Nam</h2>
                <p>Bánh mì Việt Nam là sự kết hợp hoàn hảo giữa ẩm thực Pháp và Việt, tạo nên một món ăn độc đáo và hấp dẫn.</p>
                
                <h3>Nguyên liệu</h3>
                <h4>Cho bánh:</h4>
                <ul>
                <li>Bột mì: 500g</li>
                <li>Men nướng: 7g</li>
                <li>Muối: 10g</li>
                <li>Đường: 20g</li>
                <li>Nước ấm: 300ml</li>
                </ul>
                
                <h4>Cho nhân:</h4>
                <ul>
                <li>Thịt nướng hoặc pate</li>
                <li>Dưa chua, cà rốt</li>
                <li>Rau thơm: ngò, rau răm</li>
                <li>Ớt, dưa leo</li>
                </ul>
                
                <h3>Cách làm</h3>
                <p><strong>Bước 1:</strong> Trộn bột với men, muối, đường. Thêm nước từ từ và nhào đều.</p>
                <p><strong>Bước 2:</strong> Ủ bột 1-2 tiếng cho nở đôi.</p>
                <p><strong>Bước 3:</strong> Tạo hình và nướng ở 200°C trong 20-25 phút.</p>
                <p><strong>Bước 4:</strong> Kẹp nhân và thưởng thức!</p>',

            'yoga_beginner' => '<h2>Yoga cho người mới bắt đầu</h2>
                <p>Yoga không chỉ giúp cải thiện sức khỏe thể chất mà còn mang lại sự bình an cho tâm hồn.</p>
                
                <h3>Lợi ích của Yoga</h3>
                <ul>
                <li>Tăng cường sức mạnh và độ dẻo dai</li>
                <li>Cải thiện tư thế và cân bằng</li>
                <li>Giảm stress và lo âu</li>
                <li>Cải thiện chất lượng giấc ngủ</li>
                </ul>
                
                <h3>Các tư thế cơ bản</h3>
                <h4>1. Mountain Pose (Tadasana)</h4>
                <p>Đứng thẳng, hai chân song song, tay thả lỏng hai bên. Hít thở sâu và cảm nhận sự cân bằng.</p>
                
                <h4>2. Downward Dog (Adho Mukha Svanasana)</h4>
                <p>Từ tư thế bò, đẩy hông lên cao, tạo hình tam giác ngược với cơ thể.</p>
                
                <h4>3. Child\'s Pose (Balasana)</h4>
                <p>Quỳ xuống, ngồi trên gót chân, cúi người về phía trước và duỗi tay.</p>
                
                <h3>Tips cho người mới</h3>
                <p>- Bắt đầu từ từ, không ép buộc cơ thể<br>
                - Tập trung vào hơi thở<br>
                - Luyện tập đều đặn mỗi ngày</p>',

            'js_frameworks' => '<h2>Top 10 JavaScript Frameworks 2024</h2>
                <p>JavaScript ecosystem tiếp tục phát triển mạnh mẽ với nhiều framework và library mới. Dưới đây là top 10 được sử dụng nhiều nhất.</p>
                
                <h3>1. React</h3>
                <p>Vẫn là king của frontend với ecosystem phong phú và cộng đồng lớn.</p>
                
                <h3>2. Vue.js</h3>
                <p>Framework progressive với learning curve dễ dàng, phù hợp cho mọi dự án.</p>
                
                <h3>3. Angular</h3>
                <p>Framework full-featured của Google, mạnh mẽ cho enterprise applications.</p>
                
                <h3>4. Svelte</h3>
                <p>Compile-time framework với performance tuyệt vời và bundle size nhỏ.</p>
                
                <h3>5. Next.js</h3>
                <p>React framework với SSR, SSG và nhiều tính năng production-ready.</p>
                
                <h3>6. Nuxt.js</h3>
                <p>Vue.js framework tương tự Next.js với nhiều tính năng tích hợp.</p>
                
                <h3>7. Express.js</h3>
                <p>Minimal và flexible Node.js framework cho backend development.</p>
                
                <h3>8. Nest.js</h3>
                <p>Progressive Node.js framework sử dụng TypeScript và decorator pattern.</p>
                
                <h3>9. Gatsby</h3>
                <p>Static site generator dựa trên React với performance tối ưu.</p>
                
                <h3>10. Astro</h3>
                <p>Modern static site builder với zero JavaScript by default.</p>',

            'tech_news' => '<h2>Tin tức công nghệ tuần này</h2>
                <p>Cập nhật những tin tức công nghệ hot nhất trong tuần qua từ các ông lớn công nghệ.</p>
                
                <h3>AI và Machine Learning</h3>
                <p>OpenAI ra mắt phiên bản GPT mới với khả năng xử lý multimodal tốt hơn. Google cũng không kém cạnh với Gemini Ultra.</p>
                
                <h3>Web Development</h3>
                <p>React 19 beta được release với nhiều tính năng mới như Server Components và Concurrent Features.</p>
                
                <h3>Mobile Development</h3>
                <p>Flutter 3.19 cải thiện performance và thêm nhiều widget mới. React Native cũng update với New Architecture.</p>
                
                <h3>Cloud Computing</h3>
                <p>AWS, Azure và Google Cloud đều công bố các dịch vụ AI mới với giá cả cạnh tranh hơn.</p>
                
                <h3>Cybersecurity</h3>
                <p>Nhiều lỗ hổng bảo mật mới được phát hiện, các công ty cần cập nhật patch ngay lập tức.</p>'
        ];

        return $contents[$type] ?? '<p>Nội dung mẫu cho bài viết.</p>';
    }
} 