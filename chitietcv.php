<!DOCTYPE html>
<html>
    <head>
        <title>Chi tiết công việc</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/chitietcv1.css">
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
                //đăng xuất
            if(isset($_GET['ac']) && $_GET['ac']=='logout'){
                unset($_SESSION['daDangNhap']);
                header('location:dangnhap.php');
            }
                // lấy id công việc
                $layId = null;
                if(isset($_GET['chitiet']) && !empty($_GET['chitiet'])){
                    $layId = $_GET['chitiet'];
                }
                // hiện công việc
                $sql_qt = "select * from congViec where id_cv = '$layId'";
                $run_sql_qt = $db->query($sql_qt);
                $array = $run_sql_qt->fetchArray();
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
            <a href="trangchu.php?ac=logout" id="dx">
                <span> Đăng xuất</span>
            </a>
          
        </div>
            </div>
    
            <div class="banner">
                <img src="img/banner_01_new.png">
                <div id="timkiem">
                   
                <a href="timkiem.php" name="timKiem" id="btsearch" style = "text-decoration: none;">Tìm Kiếm</a>
                </div>
            </div>


        <div class="main">
        <form action="chitietcv.php?dn=chitietcv">
            <div class="tieude">
               <div>
                    <h1><?php echo $array["viTriTuyenDung"];?></h1>
                    <h2><?php echo $array["tenCty"]?></h2>
               </div>
               <div>
                   <span style="font-weight: bold;">Hạn nộp hồ sơ:</span>
                   <span><?php echo $array["hanNopHs"]?></span>
               </div>
            </div>
            
            <div class="noidungchinh">
                <div class="nd1">
                    <table>
                        <tr>
                            <td>Mức lương: <span><?php echo $array["luong"]?></span></td>
                            <td>Địa điểm làm việc: <span><?php echo $array["khuVuc"]?></span></td>
                        </tr>
                        <tr>
                            <td>Số lượng: <span><?php echo $array["soLuong"]?></span></td>
                            <td>Vị trí tuyển dụng: <span><?php echo $array["viTriTuyenDung"]?></span></td>
                        </tr>
                        <tr>
                            <td>Ngành: <span><?php echo $array["nganhTuyen"]?></span></td>
                            <td>Nơi nộp hồ sơ: <span><?php echo $array["diaDiem"]?></span></td>
                        </tr>
                    </table>
                </div>
                <div class="nd2">
                    <!-- nhà tuyển dụng -->
                    <h2>Giới thiệu về công ty</h2>
                    <table>
                        <tr>
                            <td>
                                <?php echo $array["nhaTuyenDung"] ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="nd2">
                    <h2>Mô tả công việc</h2>
                    <table>
                        <tr>
                            <td>
                                <?php echo $array["moTaCongViec"] ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="nd2">
                    <h2>Yêu cầu công việc</h2>
                    <table>
                        <tr>
                            <td>
                                <?php echo $array["yeuCau"]?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="nd2">
                    <h2>Quyền lợi</h2>
                    <table>
                        <tr>
                            <td>
                                <?php echo $array["quyenLoi"]?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="nd1">
                    <h2>Thông tin liên hệ</h2>
                    <table>
                        <tr>
                            <td>Số điện thoại: <span><?php echo $array["sđt"]?></span></td>
                        </tr>
                        <tr>
                            <td>Email: <span><?php echo $array["email"]?></span></td>
                        </tr>
                    </table>
                </div>
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