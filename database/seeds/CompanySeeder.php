<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
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
                'CompanyName' => 'Công ty cổ phần MISA',
                'Address'=>'ngõ 15, phố Duy Tân, Cầu Giấy, Hà Nội',
                'Introduction'=>'Công ty cổ phần MISA là công ty phần mềm Product tạo ra những phần mềm có ứng dụng cao cho các ngành nghề',
                'StartDateWorking'=>'Thứ 2',
                'EndDateWorking'=>'Thứ 7',  
                'CompanySize'=>3000,
                'TypeBussiness'=>'Product'          
            ],
            [
                'CompanyName' => 'Trung tâm phát triển và nghiên cứu thiết bị di động SamSung',
                'Address'=>'Số 1, đường Phạm Văn Bạch, Cầu Giấy, Hà Nội',
                'Introduction'=>'SVMC là trung tâm nghiên cứu lớn nhất của SAMSUNG tại khu vực Đông Nam Á. Chúng tôi không ngừng đổi mới để tạo ra một nơi làm việc tốt nhất (Great Work Place), chính sách đào tạo phát triển nhân tài bài bản, cùng chế độ lương thưởng cạnh tranh, công bằng nhằm nâng cao hiệu quả làm việc và sự gắn bó lâu dài của nhân viên.
                Được thành lập năm 2012, đến nay SVMC đã xây dựng được một đội ngũ nhân viên với hơn 1.000 kỹ sư trong lĩnh vực nghiên cứu và phát triển phần mềm ĐTDĐ, trong đó có nhiều Tiến sỹ, Thạc sỹ được đào tạo chuyên sâu ở nước ngoài. Trụ sở chính của SVMC được đặt tại Tòa nhà PVI, số 1 Phạm Văn Bạch, Cầu Giấy, Hà Nội. Không chỉ nghiên cứu và phát triển phần mềm ĐTDĐ, SVMC còn tham gia chuyển giao công nghệ tiên tiến đưa vào dây chuyền sản xuất tại 2 nhà máy lớn nhất tập đoàn ở Bắc Ninh và Thái Nguyên, góp phần vào thành công to lớn của tập đoàn Samsung Electronics - trở thành một trong những doanh nghiệp có vốn đầu tư nước ngoài thành công nhất tại Việt Nam.',
                'StartDateWorking'=>'Thứ 2',
                'EndDateWorking'=>'Thứ 6',  
                'CompanySize'=>15000,
                'TypeBussiness'=>'Product'          
            ],       
            [
                'CompanyName' => 'Tập Đoàn Công Nghiệp – Viễn Thông Quân Đội Viettel',
                'Address'=>'Tầng 41, tòa nhà KeangNam, đường Phạm Hùng, Hà Nội',
                'Introduction'=>'Viettel là một trong những doanh nghiệp viễn thông có số lượng khách hàng lớn nhất trên thế giới. Với kinh nghiệm phổ cập hoá viễn thông tại nhiều quốc gia đang phát triển, chúng tôi hiểu rằng được kết nối là một nhu cầu rất cơ bản của con người. Chúng tôi cũng hiểu rằng, kết nối con người giờ đây không chỉ là thoại và tin nhắn, đó còn là phương tiện để con người tận hưởng cuộc sống, sáng tạo và làm giàu. Bởi vậy, bằng cách tiếp cận sáng tạo của mình, chúng tôi luôn nỗ lực để kết nối con người vào bất cứ lúc nào cho dù họ là ai và họ đang ở bất kỳ đâu.
                Viettel hiện là nhà cung cấp dịch vụ viễn thông lớn tại Việt Nam, đầu tư, hoạt động và kinh doanh tại 13 quốc gia trải dài từ Châu Á, Châu Mỹ, Châu Phi với quy mô thị trường 270 triệu dân, gấp khoảng 3 lần dân số Việt Nam. ',
                'StartDateWorking'=>'Thứ 2',
                'EndDateWorking'=>'Thứ 7',  
                'CompanySize'=>30000,
                'TypeBussiness'=>'Product'          
            ],       
            [
                'CompanyName' => 'Công ty cổ phần kỹ thuật Tùng Vân',
                'Address'=>'Tòa nhà Handico 6, đường Lê Văn Lương, phường Trung Hòa, Hà Nội',
                'Introduction'=>'Công ty phát triển các ứng dụng truyền hình',
                'StartDateWorking'=>'Thứ 2',
                'EndDateWorking'=>'Thứ 7',  
                'CompanySize'=>1000,
                'TypeBussiness'=>'Outsource'          
            ],        
            [
                'CompanyName' => 'FPT Software - Công ty TNHH Phần Mềm FPT',
                'Address'=>'FPT Cau Giay Building, Duy Tan Street, Cau Giay District, Hanoi, Vietnam',
                'Introduction'=>'Thành lập từ năm 1988 đến nay với 3 Trụ sở chính FPT Software đặt tại Việt Nam và một số nước trên toàn thế giới như Hoa Kỳ, Nhật Bản, Malaysia, Đức, Úc, Singapore, Malaysia, Thái Lan và Philipines hiện FPT Software đáp ứng nhu cầu gia công phần mềm lớn cho hơn 150 công ty hàng đầu tại 20 quốc gia lớn nhất trên thế giới hiện nay với các hợp đồng lớn có khi đạt cả 1 triệu USD dành cho một số đối tác lớn như Hitachi, NEOPOST, Petronas, Deutsche Bank, và Unilever với hơn 4000 nhân viên trên toàn thế giới',
                'StartDateWorking'=>'Thứ 2',
                'EndDateWorking'=>'Thứ 6',  
                'CompanySize'=>13000,
                'TypeBussiness'=>'Product'          
            ],
            ];
            \DB::table('companies')->insert($posts);
    }
}
