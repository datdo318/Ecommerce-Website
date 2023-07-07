<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'TienDat',
                'email' => 'datvbhp123@gmail.com',
                'password' => Hash::make('datvbhp1234'),
                'avatar' => null,
                'level' => 2,
                'description' => null,

                'company_name' => 'True',
                'country' => 'Viet Nam',
                'street_address' => 'Hai Phong',
                'postcode_zip' => '10000',
                'town_city' => 'Hai Phong',
                'phone' => '0932981298',
            ],
        ]);

        DB::table('users')->insert([

            [
                'id' => 2,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => null,
                'level' => 0,
                'description' => null,
            ],
            [
                'id' => 3,
                'name' => 'Truong',
                'email' => 'truong@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => '3.jpg',
                'level' => 2,
                'description' => 'Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud amodo'
            ],
            [
                'id' => 4,
                'name' => 'Tuan',
                'email' => 'tuan@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => '4.jpg',
                'level' => 1,
                'description' => null,
            ],
            [
                'id' => 5,
                'name' => 'Yen',
                'email' => 'yen@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => null,
                'level' => 2,
                'description' => null,
            ],
        ]);

        DB::table('blogs')->insert([
            [
                'user_id' => 3,
                'title' => 'Phong cách phối đồ phù hợp cho chuyến đi biển',
                'subtitle' => '',
                'image' => 'blog-1.jpg',
                'category' => 'TRAVEL',
                'content' => 'Trong thời tiết mùa hè nóng nực, việc chọn trang phục diện đến công sở trở thành bài toán khó với nhiều chị em. Outfit mặc đi làm cần đáp ứng một số tiêu chí, đó là nhẹ mát, thoải mái nhưng vẫn đảm bảo nét thanh lịch. Và để dễ dàng mặc đẹp trong những ngày hè nóng bức, chị em hãy tham khảo 5 công thức diện đồ công sở "giải nhiệt" hiệu quả sau đây:<br/> Áo thun là món thời trang đậm chất street style, nhưng item này vẫn phù hợp để diện đến công sở. Bí kíp ở đây chính là ưu tiên các phiên bản áo thun mang tông màu trung tính, như trắng hoặc be. Với chất liệu vải cotton, áo thun sẽ tạo cảm giác mát mẻ, dễ chịu khi chị em diện trong ngày nóng bức. Kết hợp áo thun với quần âu ống rộng, chị em sẽ có ngay tổng thể trang phục thanh lịch, đúng chất công sở. Chưa hết, sơ vin là thao tác cần thiết khi diện áo thun và quần âu, vì đảm bảo vẻ chỉn chu cho outfit đi làm.<br/> Áo sơ mi oversized và quần âu ống rộng là "cặp bài trùng" hoàn hảo. Với độ rộng rãi và thoải mái, combo này sẽ giúp giải nhiệt trong những ngày hè nóng đỉnh điểm. Áo sơ mi oversized và quần âu ống suông ghi điểm ở sự thanh lịch, nhưng combo này còn toát lên nét trẻ trung, phóng khoáng. Đối với áo sơ mi và quần âu ống suông, bạn có thể kết hợp theo cách đơn giản nhất, vẻ ngoài vẫn ấn tượng. Những mẫu giày phù hợp với combo áo sơ mi oversized + quần âu ống suông bao gồm: Sandal quai mảnh, sneaker trắng, loafer hoặc giày cao gót mũi nhọn.',
            ],
            [
                'user_id' => 3,
                'title' => 'Đây là một trong những ngày đầu tiên của chúng tôi ở Hawaii vào tuần trước.',
                'subtitle' => '',
                'image' => 'blog-2.jpg',
                'category' => 'CodeLeanON',
                'content' => '',
            ],
            [
                'user_id' => 3,
                'title' => 'Tuần trước tôi có chuyến công tác đầu tiên trong năm tới Thung lũng Sonoma',
                'subtitle' => '',
                'image' => 'blog-3.jpg',
                'category' => 'TRAVEL',
                'content' => '',
            ],
            [
                'user_id' => 3,
                'title' => 'Chúc mừng năm mới! Tôi biết tôi hơi muộn về bài đăng này',
                'subtitle' => '',
                'image' => 'blog-4.jpg',
                'category' => 'CodeLeanON',
                'content' => '',
            ],
            [
                'user_id' => 3,
                'title' => 'Top trang phục được giới trẻ yêu thích nhất',
                'subtitle' => '',
                'image' => 'blog-5.jpg',
                'category' => 'MODEL',
                'content' => '',
            ],
            [
                'user_id' => 3,
                'title' => 'Đi ăn tiệc nên mặc gì?',
                'subtitle' => '',
                'image' => 'blog-6.jpg',
                'category' => 'CodeLeanON',
                'content' => '',
            ],
        ]);

        DB::table('brands')->insert([
            [
                'name' => 'Calvin Klein',
            ],
            [
                'name' => 'Diesel',
            ],
            [
                'name' => 'Polo',
            ],
            [
                'name' => 'Tommy Hilfiger',
            ],
        ]);

        DB::table('product_categories')->insert([
            [
                'name' => 'Nam',
            ],
            [
                'name' => 'Nữ',
            ],
            [
                'name' => 'Trẻ em',
            ],
        ]);

        DB::table('products')->insert([
            [
                'id' => 1,
                'brand_id' => 1,
                'product_category_id' => 2,
                'name' => 'Áo len Hàn Quốc',
                'description' => 'Sản phẩm phù hợp với phong cách thời trang gọn gàng, kín đáo',
                'content' => 'Xin chào các bạn mình là Đạt',
                'price' => 199000,
                'qty' => 20,
                'discount' => 159000,
                'weight' => 1.3,
                'sku' => '00012',
                'featured' => true,
                'tag' => 'Clothing', //Clothing
                'vn_tag' => 'Quần áo'
            ],
            [
                'id' => 2,
                'brand_id' => 2,
                'product_category_id' => 2,
                'name' => 'Áo Cadigan len siêu xinh',
                'description' => null,
                'content' => null,
                'price' => 259000,
                'qty' => 20,
                'discount' => 179000,
                'weight' => 2.0,
                'sku' => '00013',
                'featured' => true,
                'tag' => 'Clothing',
                'vn_tag' => 'Quần áo'
            ],
            [
                'id' => 3,
                'brand_id' => 3,
                'product_category_id' => 2,
                'name' => 'Áo khoác sweater',
                'description' => null,
                'content' => null,
                'price' => 299000,
                'qty' => 20,
                'discount' => 199000,
                'weight' => 1.4,
                'sku' => '00014',
                'featured' => true,
                'tag' => 'Clothing',
                'vn_tag' => 'Quần áo'
            ],
            [
                'id' => 4,
                'brand_id' => 4,
                'product_category_id' => 1,
                'name' => 'Khăn len quàng cổ',
                'description' => null,
                'content' => null,
                'price' => 99000,
                'qty' => 20,
                'discount' => 59000,
                'weight' => 1.2,
                'sku' => '00015',
                'featured' => true,
                'tag' => 'Accessories',
                'vn_tag' => 'Phụ kiện'
            ],
            [
                'id' => 5,
                'brand_id' => 1,
                'product_category_id' => 3,
                'name' => "Mũ lưỡi trai SUBWAY",
                'description' => null,
                'content' => null,
                'price' => 129000,
                'qty' => 20,
                'discount' => 99000,
                'weight' => 0.9,
                'sku' => '00016',
                'featured' => false,
                'tag' => 'Accessories', //Accessories
                'vn_tag' => 'Phụ kiện'
            ],
            [
                'id' => 6,
                'brand_id' => 1,
                'product_category_id' => 2,
                'name' => 'Áo len cổ tròn',
                'description' => null,
                'content' => null,
                'price' => 179000,
                'qty' => 20,
                'discount' => 119000,
                'weight' => 0.8,
                'sku' => '00017',
                'featured' => true,
                'tag' => 'Clothing',
                'vn_tag' => 'Quần áo'
            ],
            [
                'id' => 7,
                'brand_id' => 1,
                'product_category_id' => 1,
                'name' => 'Balo ULZZANG BASIC',
                'description' => null,
                'content' => null,
                'price' => 499000,
                'qty' => 20,
                'discount' => 299000,
                'weight' => 1.7,
                'sku' => '00018',
                'featured' => true,
                'tag' => 'HandBag', //HandBag
                'vn_tag' => 'Balo/Túi xách'
            ],
            [
                'id' => 8,
                'brand_id' => 1,
                'product_category_id' => 1,
                'name' => 'Áo khoác thu đông',
                'description' => null,
                'content' => null,
                'price' => 269000,
                'qty' => 20,
                'discount' => 199000,
                'weight' => 1.1,
                'sku' => '00019',
                'featured' => true,
                'tag' => 'Clothing',
                'vn_tag' => 'Quần áo'
            ],
            [
                'id' => 9,
                'brand_id' => 1,
                'product_category_id' => 1,
                'name' => 'Giày Nike Air Force',
                'description' => null,
                'content' => null,
                'price' => 999000,
                'qty' => 20,
                'discount' => 499000,
                'weight' => 2.3,
                'sku' => '00020',
                'featured' => true,
                'tag' => 'Shoes',
                'vn_tag' => 'Giày dép'
            ],
        ]);

        DB::table('product_images')->insert([
            [
                'product_id' => 1,
                'path' => 'product-1.jpg',
            ],
            [
                'product_id' => 1,
                'path' => 'product-1-1.jpg',
            ],
            [
                'product_id' => 1,
                'path' => 'product-1-2.jpg',
            ],
            [
                'product_id' => 2,
                'path' => 'product-2.jpg',
            ],
            [
                'product_id' => 3,
                'path' => 'product-3.jpg',
            ],
            [
                'product_id' => 4,
                'path' => 'product-4.jpg',
            ],
            [
                'product_id' => 5,
                'path' => 'product-5.jpg',
            ],
            [
                'product_id' => 6,
                'path' => 'product-6.jpg',
            ],
            [
                'product_id' => 7,
                'path' => 'product-7.jpg',
            ],
            [
                'product_id' => 8,
                'path' => 'product-8.jpg',
            ],
            [
                'product_id' => 9,
                'path' => 'product-9.jpg',
            ],
        ]);

        DB::table('product_details')->insert([
            [
                'product_id' => 1,
                'color' => 'blue',
                'size' => 'S',
                'qty' => 5,
            ],
            [
                'product_id' => 1,
                'color' => 'blue',
                'size' => 'M',
                'qty' => 5,
            ],
            [
                'product_id' => 1,
                'color' => 'blue',
                'size' => 'L',
                'qty' => 5,
            ],
            [
                'product_id' => 1,
                'color' => 'blue',
                'size' => 'XS',
                'qty' => 5,
            ],
            [
                'product_id' => 1,
                'color' => 'yellow',
                'size' => 'S',
                'qty' => 0,
            ],
            [
                'product_id' => 1,
                'color' => 'violet',
                'size' => 'S',
                'qty' => 0,
            ],
        ]);

        DB::table('product_comments')->insert([
            [
                'product_id' => 1,
                'user_id' => 4,
                'email' => 'tuan@gmail.com',
                'name' => 'Tuan',
                'message' => 'Nice !',
                'rating' => 4,
            ],
            [
                'product_id' => 1,
                'user_id' => 5,
                'email' => 'yen@gmail.com',
                'name' => 'Yen',
                'message' => 'Nice !',
                'rating' => 4,
            ],
        ]);
    }
}
