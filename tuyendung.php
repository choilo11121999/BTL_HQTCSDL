<!DOCTYPE html>
<html>
    <head>
    <title>Tuyển dụng</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/tuyendung.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-free-5.11.2-web/css/all.min.css"> 
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1.0, user-scalable=no" name="viewport">
    </head>
    <body>
    <?php
        session_start();
        class MyDB extends SQLite3
        {
            function __construct()
            {
            $this->open('test.db');
            }
        }
        $db = new MyDB();
        $email_dung = null;
        //đăng xuất
        if(isset($_GET['ac']) && $_GET['ac']=='logout'){
            unset($_SESSION['daDangNhap']);
            header('location:dangnhap.php');
        }
        if(isset($_SESSION['daDangNhap'])){
            $email_dung = $_SESSION['daDangNhap'];
        }
        if(isset($_POST['dangTuyen']) && isset($_SESSION['daDangNhap']) ){
            $Cty = $_POST['Cty'];
            $khuVuc = $_POST['khuVuc'];
            $nganhTuyen = $_POST['nganhTuyen'];
            $viTriTuyen = $_POST['viTriTuyen'];
            $nhaTuyenDung = $_POST['nhaTuyenDung'];
            $soLuong = $_POST['soLuong'];
            $MoTaCV = $_POST['moTa'];
            $yeuCau = $_POST['yeuCau'];
            $quyenLoi = $_POST['quyenLoi'];
            $luong = $_POST['luong'];
            $hanNop = $_POST['hanNop'];
            $diaDiem = $_POST['diaDiem'];
            $sđt = $_POST['sđt'];
            $email = $_POST['email'];
            // lấy thông tin tài khoản đang dùng
            $sql_layId_actor ="select id from Actor where email = '$email_dung'"; 
            $run_sql_layId_acTor = $db->query($sql_layId_actor);
            $array_layId = $run_sql_layId_acTor->fetchArray();
            $id_actor = $array_layId["id"];

            $sql_dangtuyen = "insert into congViec(id_actor , tenCty, khuVuc , nganhTuyen, viTriTuyenDung ,soLuong,luong,hanNopHs,diaDiem,email,sđt, nhaTuyenDung , moTaCongViec , yeuCau , quyenLoi)
             values('$id_actor','$Cty', '$khuVuc','$nganhTuyen','$viTriTuyen' , '$soLuong' ,'$luong','$hanNop' , '$diaDiem' , '$email' , '$sđt' , '$nhaTuyenDung' , '$MoTaCV'  , '$yeuCau' ,'$quyenLoi')";
             $run = $db->query($sql_dangtuyen);
             if($run){
                header('location:trangchu.php');

             }
             else{
                header('location:tuyendung.php');
             }
        }
    ?>
        <div id="header">
            <div class="kv-ntd">
                <i class="fas fa-location-arrow"></i>
                <select name="location">
                    <option value="1" selected>Miền Bắc</option>
                    <option value="2">Miền Trung</option>
                    <option value="3">Miền Nam</option>
                </select>
                <a href="tuyendung.php" style="font-weight: bold; color: green;">
                    <i class="fas fa-hand-holding-usd"></i>
                    Nhà tuyển dụng
                </a>
                <a href="quantam.php">Việc quan tâm</a>
            </div>
    
            <div class="logo-center" title="Trang chủ">
                <a href="trangchu.php" style="color: #333; text-decoration: none;">
                    <i class="fab fa-wordpress-simple"></i>
                    Tìm Việc Làm
                </a>
            </div>
            <div class="dn-dk">
                    <a href="baidang.php" id="baidang">
                            Việc đã đăng
                    </a>
                <a href="tuyendung.php?ac=logout" id="dn" title="Đăng xuất">
                    Đăng xuất
                </a>
            </div>
        </div>
        
        <div class="main">
        <form action="tuyendung.php?dn=tuyendung" method="POST">
            <div class="row">
                <label>Tên công ty</label>
                <input type="text" name="Cty" placeholder="Nhập tên công ty">
            </div>
            <div class="row">
                <label>Khu vực tuyển dụng</label>
                <select name="khuVuc">
                    <option>Chọn nơi làm việc</option>
                    <option value="Hà Nội">Hà Nội</option>
                    <option value="TP Hồ Chí Minh">TP Hồ Chí Minh</option>
                    <option value="Đà Nẵng">Đà Nẵng</option>
                    <option value="Bắc Ninh">Bắc Ninh</option>
                    <option value="Hà Nam">Hà Nam</option>
                    <option value="Hải Dương">Hải Dương</option>
                    <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                    <option value="Hòa Bình">Hòa Bình</option>
                    <option value="Lai Châu">Lai Châu</option>
                    <option value="Nam Định">Nam Định</option>
                    <option value="Ninh Bình">Ninh Bình</option>
                    <option value="Hải Phòng">Hải Phòng</option>
                    <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                    <option value="Thanh Hóa">Thanh Hóa</option>
                    <option value="Nghệ An">Nghệ An</option>
                    <option value="Hà Tĩnh">Hà Tĩnh</option>
                    <option value="Quảng Nam">Quảng Nam</option>
                    <option value="Bình Định">Bình Định</option>
                    <option value="Khánh Hòa">Khánh Hòa</option>
                    <option value="Quảng Bình">Quảng Bình</option>
                    <option value="Quảng Trị">Quảng Trị</option>
                    <option value="Bà Rịa Vũng Tàu">Bà Rịa Vũng Tàu</option>
                    <option value="Bình Dương">Bình Dương</option>
                    <option value="Bình Phước">Bình Phước</option>
                    <option value="Đồng Nai">Đồng Nai</option>
                    <option value="Tây Ninh">Tây Ninh</option>
                    <option value="Cà Mau">Cà Mau</option>
                    <option value="Đồng Tháp">Đồng Tháp</option>
                    <option value="Long An">Long An</option>
                    <option value="Sóc Trăng">Sóc Trăng</option>
                </select>
            </div>
            <div class="row">
                <label>Ngành tuyển dụng </label>
                <select name="nganhTuyen" id="">
                    <option>Chọn ngành nghề</option>
                    <option value="Kinh doanh">Kinh doanh</option>
                    <option value="Chăm sóc khách hàng">Chăm sóc khách hàng</option>
                    <option value="Sinh viên/Mới tốt nghiệp/Thực tập">Sinh viên/Mới tốt nghiệp/Thực tập</option>
                    <option value="Lao động phổ thông">Lao động phổ thông</option>
                    <option value="Hành chính/Thư ký/Trợ lý">Hành chính/Thư ký/Trợ lý</option>
                    <option value="Tài chính/Kế toán/Kiểm toán">Tài chính/Kế toán/Kiểm toán</option>
                    <option value="Quảng cáo/Marketing/PR">Quảng cáo/Marketing/PR</option>
                    <option value="Bất động sản">Bất động sản</option>
                    <option value="Du lịch/Nhà hàng/Khách sạn">Du lịch/Nhà hàng/Khách sạn</option>
                    <option value="Cơ khí/Kĩ thuật ứng dụng">Cơ khí/Kĩ thuật ứng dụng</option>
                    <option value="Công nghệ thông tin">Công nghệ thông tin</option>
                    <option value="Điện/Điện tử/Điện lạnh">Điện/Điện tử/Điện lạnh</option>
                    <option value="Nhân sự">Nhân sự</option>
                    <option value="Xây dựng">Xây dựng</option>
                    <option value="Bảo vệ/Vệ sĩ/An ninh">Bảo vệ/Vệ sĩ/An ninh</option>
                    <option value="Ngân hàng/Chứng khoán/Đầu tư">Ngân hàng/Chứng khoán/Đầu tư</option>
                    <option value="Kho vận/Vật tư/Thu mua">Kho vận/Vật tư/Thu mua</option>
                    <option value="Thời vụ/Bán thời gian">Thời vụ/Bán thời gian</option>
                    <option value="Dược/Hóa chất/Sinh hóa">Dược/Hóa chất/Sinh hóa</option>
                </select>
            </div>
            <div class="row">
                <label>Vị trí tuyển dụng</label>
                <input type="text" name="viTriTuyen" placeholder="Nhập vị trí tuyển dụng">
            </div>
            <div class="row">
                <label>Số lượng cần tuyển</label>
                <input type="number" name="soLuong">
            </div>
            <div class="row">
                <label>Lương</label>
                <input type="text" name="luong" placeholder="Nhập lương">
            </div>
            <div class="row">
                <label>Hạn nộp hồ sơ</label>
                <input  type="date" name="hanNop">
            </div>
            <div class="row">
                <label>Địa điểm nộp hồ sơ</label>
                <input type="text" name="diaDiem" placeholder="Nhập địa điểm nộp hồ sơ">
            </div>
            <div class="row">
                <label for="">Email</label>
                <input type="email" name="email">
            </div>
            <div class="row">
                <label for="">Số điện thoại</label>
                <input type="tel" name="sđt">
            </div>
            <div class="row">
                <label>Nhà tuyển dụng</label>
                <textarea name="nhaTuyenDung" placeholder="Giới thiệu nhà tuyển dụng"></textarea>
            </div>
            <div class="row">
                <label>Mô tả công viêc</label>
                <textarea name="moTa" placeholder="Mô tả về công việc"></textarea>
            </div>
            <div class="row">
                <label>Yêu cầu công việc</label>
                <textarea name="yeuCau" placeholder="Mô tả yêu cầu công việc"></textarea>
            </div>
            <div class="row">
                <label>Quyền lợi</label>
                <textarea name="quyenLoi" placeholder=""></textarea>
            </div>
            <div >
                <input id="submit" name="dangTuyen" type="submit" value="Đăng tuyển">
            </div>
    </form>
        </div>

        <div class="footer">
            <div>
                <h2>Liên hệ</h2>
                <ul>
                    <li>
                        <h4>Admin</h4>
                        <p>-Hotline: <span style="color: red; font-weight: bold;">0368368368</span></p>
                        <p>-Email: <span>admin@timviec.com</span></p>
                    </li>
                    <li>
                        <h4>Hỗ trợ Nhà tuyển dụng</h4>
                        <p>-Hotline: <span style="color: red; font-weight: bold;">0385385385</span></p>
                        <p>-Email: <span>hotrotuyendung@timviec.com</span></p>
                    </li>
                    <li>
                        <h4>Hỗ trợ người tìm việc</h4>
                        <p>-Hotline: <span style="color: red; font-weight: bold;">0387387387</span></p>
                        <p>-Email: <span>hotrotimviec@timviec.com</span></p>
                    </li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <img src="img/logo-ft.png" alt="">
                    </li>
                    <li class="li">
                        <h3>Công ty cổ phần Tìm Việc Làm</h3>
                        <br>
                        <h4>Trụ sở: <span style="font-weight: normal;">144 Xuân Thủy, Cầu giấy, Hà Nội</span></h4>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>