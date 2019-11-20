<!DOCTYPE html>
<html>

<head>
    <title>Tìm kiếm</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-free-5.11.2-web/css/all.min.css">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1.0, user-scalable=no"
        name="viewport">


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
          //đăng xuất
          if(isset($_GET['ac']) && $_GET['ac']=='logout'){
            unset($_SESSION['daDangNhap']);
            header('location:dangnhap.php');
        }
         $email_dung = null;
            
           
         if(isset($_SESSION['daDangNhap']))
        {
        $email_dung = $_SESSION['daDangNhap'];
        }
        // lấy thông tin người dùng
        $sql_lay_actor ="select id , hoTen from Actor where email = '$email_dung'"; 
        $run_sql_lay_acTor = $db->query($sql_lay_actor);
        $array_lay = $run_sql_lay_acTor->fetchArray();
        $id_actor = $array_lay["id"];
        $hoTen_actor = $array_lay["hoTen"];
         $tencv = null;
         $nganh = null;
         $khuVuc = null;
         if(isset($_POST['timKiem'])){
             $tencv = $_POST['tenCv'];
             $nganh = $_POST['nganhTuyen'];
             $khuVuc = $_POST['khuVuc'];
         }
             $sqlite = "select * from congViec where viTriTuyenDung like '%$tencv%' and nganhTuyen ='$nganh' and khuVuc = '$khuVuc' ";
             $run_query = $db->query($sqlite);
          //thêm công việc quan tâm
          $layId = null;
          if(isset($_GET['add']) && !empty($_GET['add'])){
              $layId = $_GET['add'];
              $sql_qt = "insert into quanTamCv(id_cv_quanTam , id_actor_quanTam) values('$layId' , '$id_actor')";
              $run_sql_qt = $db->query($sql_qt);
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
            <a href="tuyendung.php">
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
        <!-- style= "font-weight: bold; font-size : 20px ; margin-right :" 20px  -->
            <p id="nguoidung"><i class="far fa-user"></i><?php echo $hoTen_actor ?></p>
            <div class="clearfix"></div>
            <a href="timkiem.php?ac=logout" id="dx">
                <span> Đăng xuất</span>
            </a>
          
        </div>
    </div>

    <div class="banner">
    <form action="timkiem.php?dn=timkiem" method="POST">
        <img src="img/banner_01_new.png">
        <div id="timkiem">
            <input type="text" name = "tenCv" placeholder="Nhập tên công việc..." id="txtsearch">
            <select name="nganhTuyen" id="">
            <option value="">Chọn ngành nghề</option>
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
            <input type="submit" name="timKiem" value="Tìm kiếm" id="btsearch">
        </div>
        </form>
    </div>


    <div class="khungnoidung">
        <div class="noidung">
            <div class="viecmoinhat">
                
                <div class="khungviecmoinhat">
                <form action="timkiem.php?dn=timkiem" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col1">Vị trí cần tuyển</th>
                                <th>Mức lương</th>
                                <th>Khu vực</th>
                                <th>Hạn nộp</th>
                                <th style="width:50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                                 <?php
                                    while($array=$run_query->fetchArray()):
                                ?>
                            <tr>
                                <td class="col1">
                                    <a href="chitietcv.php?chitiet=<?php echo $array["id_cv"]?>">
                                        <h3><?php echo $array["viTriTuyenDung"]?></h3>
                                    </a>
                                    <p style="color: #696969;"><?php echo $array["tenCty"]?> </p>
                                </td>
                                <td><span title="Lương"><i class="fas fa-dollar-sign"></i>5-7tr</span></td>
                                <td><span title="Khu vực"><i class="fas fa-map-marker-alt"></i> Hà Nội</span></td>
                                <td><span title="Hạn nộp hồ sơ"><i class="far fa-clock"></i>20/11/2019</span></td>
                                <!-- <td style="text-align: center;"><input type="submit" value="❤"
                                        style="background-color:white; color: red; font-size: 20px;"></td> -->
                                 <td style="text-align: center;"><a href="timkiem.php?add=<?php echo $array["id_cv"];?>"  style="background-color:white; color: red; font-size: 20px;text-decoration: none;">❤</a></td>
                            </tr>
                            <?php
                                endwhile;

                            ?>

                        </tbody>
                    </table>
        </form>
                </div>
            </div>
        </div>
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