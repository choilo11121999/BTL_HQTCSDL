<!DOCTYPE php>
<html>
    <head>
        <title>Đăng nhập</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/dangnhap.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome-free-5.11.2-web/css/all.min.css">
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
        if(isset($_POST['dangnhap'])){
            $email = $_POST['email'];
            $matkhau = $_POST['matkhau'];
            $sqlite = "select count(*) as num from Actor where email = '$email' and passWord = '$matkhau'";
            $run_query = $db->query($sqlite);
            $array = $run_query->fetchArray();
            $num = $array["num"];
            sleep(2);
            if($email == "admin@gmail.com"){
                $_SESSION['admin'] = $email;
                header('location:admin.php');
            }
            if($num > 0 && $email !='admin@gmail.com'){
                $_SESSION['daDangNhap'] = $email;
                header('location:trangchu.php');
            }
            else {
                ?>

            <script type = "text/javascript">
                 alert("Email hoặc mật khẩu sai !!!");
            </script>

            <?php
            }
        }
        ?>
        <div id="header">
            <a href="#" id="back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <a href="dangky.php" id="dk">
                <span>Đăng ký</span>
            </a>
        </div>
        <div id="noidung">
            <div class="logo-center">
                <a href="trangchu.php" style="color: #333; text-decoration: none;">
                    <i class="fab fa-wordpress-simple" style="color: green;"></i>
                    Tìm Việc Làm
                </a> 
            </div>
            <form action="dangnhap.php?dn=dangnhap" class="khungdn" method="POST">
                <div id="txtdn">
                    <p>Đăng nhập</p>
                </div>
                <div>
                    <input type="email" name="email" id="em" placeholder="  Email">
                </div>
                <div>
                    <input type="password" name = "matkhau" id="pws" placeholder="  Mật khẩu">
                </div>
                <div>
                    <label>
                        <input type="checkbox">
                        Nhớ đăng nhập
                    </label>
                </div>
                <div>
                    <input type="submit" name="dangnhap" value="Đăng nhập" id="btlg">
                </div>
                <div id="quenmk">
                    <a href="quenmk.php"><u>Quên mật khẩu?</u></a>
                </div>
            </form>
            <div id="dktk">
                Bạn chưa có tài khoản? <a href="dangky.php">Đăng ký</a> 
            </div>
        </div>
    </body>
</html>