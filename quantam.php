<!DOCTYPE html>
<html>
    <head>
        <title>Quan tâm</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/quantam1.css">
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
                // lấy id công việc người dùng quan tâm
                $sql = "select id_cv , viTriTuyenDung , tenCty , luong , khuVuc , hanNopHs from congViec cv 
                LEFT JOIN quanTamCv qt ON cv.id_cv = qt.id_cv_quanTam WHERE qt.id_actor_quanTam = '$id_actor' ";
                $run_sql = $db->query($sql);
                // xóa công việc quan tâm
                $layId = null;
                if(isset($_GET['delete']) && !empty($_GET['delete'])){
                    $layId = $_GET['delete'];
                    $sql_qt = "delete from quanTamCv where id_cv_quanTam = '$layId'";
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
                <a href="quantam.php" style="color: green; font-weight: bold;">Việc quan tâm</a>
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
            <a href="quantam.php?ac=logout" id="dx">
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
            <div class="viecquantam">
                <div class="khungviecquantam">
                <form action="quantam.php?dn=quantam" method="POST">
                    <table class="table">
                        <thead >
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
                                    while($array=$run_sql->fetchArray()):
                             
                                ?>
                                <tr>                                     
                                    <td class="col1">                                         
                                        <a href="chitietcv.php?chitiet=<?php echo $array["id_cv"]?>"><h3><?php echo $array["viTriTuyenDung"]?></h3></a>
                                        <p style="color: #696969;"><?php echo $array["tenCty"]?> </p>                                             
                                    </td>
                                    <td><span title="Lương"><i class="fas fa-dollar-sign"></i><?php echo $array["luong"]?></span></td>
                                    <td><span title="Khu vực"><i class="fas fa-map-marker-alt"></i> <?php echo $array["khuVuc"]?></span></td>
                                    <td><span title="Hạn nộp hồ sơ"><i class="far fa-clock"></i><?php echo $array["hanNopHs"]?></span></td>
                                    <!-- <td style="text-align: center;"><input type="submit" value="Xóa" style="background-color:white; color: red; font-size: 20px;"></td>   -->
                                    <td style="text-align: center;"><a href="quanTam.php?delete=<?php echo $array["id_cv"];?>"  style="background-color:white; color: red; font-size: 20px;text-decoration: none;">Xóa</a></td> 
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