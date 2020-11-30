<?php

use Illuminate\Database\Seeder;

class RecruiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $posts = [
            [
                'RecruiterName' => 'Nguyễn Tuấn Anh',
                'Position'=>"Nhân viên tuyển dụng",
                'Email'=>'tuananh11@gmail.com',
                'Phone'=>'0788384843',
                'Password'=>bcrypt('123456'),
                'CompanyName' => 'Công ty cổ phần MISA',
                'Address'=>'ngõ 15, phố Duy Tân, Cầu Giấy, Hà Nội',
                'City'=>'Hà Nội',
                'Introduction'=>'Công ty cổ phần MISA là công ty phần mềm Product tạo ra những phần mềm có ứng dụng cao cho các ngành nghề',
                'TimeWork'=>'8h - 17h30',
                'WorkDay'=>'Thứ 2 - Thứ 7',
                'CompanySize'=>3000,
                'TypeBusiness'=>'Product' 
            ],
            [
                'RecruiterName' => 'Nguyễn Thị Lan Anh',
                'Position'=>"Trưởng phòng nhân sự",
                'Email'=>'lanhanh232@gmail.com',
                'Phone'=>'0984773744',
                'Password'=>bcrypt('123123'),
                'CompanyName' => 'Trung tâm phát triển và nghiên cứu thiết bị di động SamSung',
                'Address'=>'Số 1, đường Phạm Văn Bạch, Cầu Giấy, Hà Nội',
                'City'=>'Hà Nội',
                'Introduction'=>'SVMC là trung tâm nghiên cứu lớn nhất của SAMSUNG tại khu vực Đông Nam Á. Chúng tôi không ngừng đổi mới để tạo ra một nơi làm việc tốt nhất (Great Work Place), chính sách đào tạo phát triển nhân tài bài bản, cùng chế độ lương thưởng cạnh tranh, công bằng nhằm nâng cao hiệu quả làm việc và sự gắn bó lâu dài của nhân viên.
                Được thành lập năm 2012, đến nay SVMC đã xây dựng được một đội ngũ nhân viên với hơn 1.000 kỹ sư trong lĩnh vực nghiên cứu và phát triển phần mềm ĐTDĐ, trong đó có nhiều Tiến sỹ, Thạc sỹ được đào tạo chuyên sâu ở nước ngoài. Trụ sở chính của SVMC được đặt tại Tòa nhà PVI, số 1 Phạm Văn Bạch, Cầu Giấy, Hà Nội. 
                Không chỉ nghiên cứu và phát triển phần mềm ĐTDĐ, SVMC còn tham gia chuyển giao công nghệ tiên tiến đưa vào dây chuyền sản xuất tại 2 nhà máy lớn nhất tập đoàn ở Bắc Ninh và Thái Nguyên, góp phần vào thành công to lớn của tập đoàn Samsung Electronics - trở thành một trong những doanh nghiệp có vốn đầu tư nước ngoài thành công nhất tại Việt Nam.',
                'TimeWork'=>'8h - 17h',
                'WorkDay'=>'Thứ 2 - Thứ 6',
                'CompanySize'=>15000,
                'TypeBusiness'=>'Outsource' 
            ],   
            [
                'RecruiterName' => 'Lê Trọng Nguyên',
                'Position'=>"Nhân viên HR",
                'Email'=>'nguyen243@gmail.com',
                'Phone'=>'0294995595',
                'Password'=>bcrypt('1204998'),
                'CompanyName' => 'Tập Đoàn Công Nghiệp – Viễn Thông Quân Đội Viettel',
                'Address'=>'Tầng 41, tòa nhà KeangNam, đường Phạm Hùng, Hà Nội',
                'City'=>'Hà Nội',
                'Introduction'=>'Viettel là một trong những doanh nghiệp viễn thông có số lượng khách hàng lớn nhất trên thế giới. Với kinh nghiệm phổ cập hoá viễn thông tại nhiều quốc gia đang phát triển, chúng tôi hiểu rằng được kết nối là một nhu cầu rất cơ bản của con người. Chúng tôi cũng hiểu rằng, kết nối con người giờ đây không chỉ là thoại và tin nhắn, đó còn là phương tiện để con người tận hưởng cuộc sống, sáng tạo và làm giàu. Bởi vậy, bằng cách tiếp cận sáng tạo của mình, chúng tôi luôn nỗ lực để kết nối con người vào bất cứ lúc nào cho dù họ là ai và họ đang ở bất kỳ đâu.
                Viettel hiện là nhà cung cấp dịch vụ viễn thông lớn tại Việt Nam, đầu tư, hoạt động và kinh doanh tại 13 quốc gia trải dài từ Châu Á, Châu Mỹ, Châu Phi với quy mô thị trường 270 triệu dân, gấp khoảng 3 lần dân số Việt Nam.',
                'TimeWork'=>'8h - 17h',
                'WorkDay'=>'Thứ 2 - Thứ 6',
                'CompanySize'=>30000,
                'TypeBusiness'=>'Outsource' 
            ],   
            [
                'RecruiterName' => 'Trần Thị Linh',
                'Position'=>"Fresher HR",
                'Email'=>'linh123@gmail.com',
                'Phone'=>'0358848583',
                'Password'=>bcrypt('1681998'),
                'CompanyName' => 'Công ty cổ phần kỹ thuật Tùng Vân',
                'Address'=>'Số 273, đường Nguyễn Trãi, phường 7, Quận 4, TPHCM',
                'City'=>'TP Hồ Chí Minh',
                'Introduction'=>'Công ty phát triển các ứng dụng truyền hình và các trang web thương mại điện tử.',
                'TimeWork'=>'8h - 17h30',
                'WorkDay'=>'Thứ 2 - Thứ 7',
                'CompanySize'=>750,
                'TypeBusiness'=>'Outsource' 
            ],
            ];
            \DB::table('recruiters')->insert($posts);
    }
}
