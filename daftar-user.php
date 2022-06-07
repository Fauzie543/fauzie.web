<?php
session_start();
    include("koneksi.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FitWorld</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- header -->
    <nav class="navbar">
        <img src = "img/fitworld1.png" height="50px">
        <div class="menu">
            <ul id="menulist">
                <li><a href="login-user.php">Log In</a></li>
            </ul>
        </div>
        <img src="img/logo.png" class = "menu1" onclick="togglemenu()">
    </nav>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Daftar Akun</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap"  class="input-control" required>
                    <input type="text" name="user" placeholder="Username"  class="input-control" required>
                    <input type="password" name="password" placeholder="password"  class="input-control" required>
                    <input type="text" name="hp" placeholder="No Hp"  class="input-control" required>
                    <input type="email" name="email" placeholder="Email"  class="input-control" required>
                    <input type="text" name="alamat" placeholder="Alamat"  class="input-control" required>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                      
                        $user_name   = $_POST['nama'];
                        $username      = $_POST['user'];
                        $password      = md5($_POST['password']);
                        $user_telp      = $_POST['hp'];
                        $user_email     = $_POST['email'];
                        $user_address    = $_POST['alamat'];
 
                        $sql = "INSERT INTO tb_user (user_name, username, password, user_telp, user_email, user_address) VALUES ('$user_name', '$username', '$password', '$user_telp', '$user_email', '$user_address')";
                        $result = mysqli_query($conn, $sql);
 
                        if($result){
                            echo '<script>alert("Daftar akun berhasil")</script>';
                            echo '<script>window.location="login-user.php"</script>';
 
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
                    }
                ?>
            </div>          
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2022 - Website</small>
        </div>
    </footer>
</body>
</html>