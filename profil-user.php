<?php
    session_start();
    include 'koneksi.php';

    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '".$_SESSION['id']."' ");
    $s = mysqli_fetch_object($query);
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
        <a href="dashboard-user.php"> <img src = "img/fitworld1.png" height="50px"></a>
        <div class="menu">
            <ul id="menulist">
                <li><a href="produk.php"><i class="fa fa-shopping-bag"></i></a></li>
                <li><a href=""><i class="fa fa-shopping-cart"></i></a></li> 
                <li><a href="daftar-user.php">Sign Up</a></li>
            </ul>
        </div>
        <img src="img/logo.png" class = "menu1" onclick="togglemenu()">
    </nav>
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" class="input-control" value="<?php echo $s->user_name ?> ">
                    <input type="text" name="user" class="input-control" value="<?php echo $s->username ?> ">
                    <input type="text" name="hp" class="input-control" value="<?php echo $s->user_telp ?> ">
                    <input type="email" name="email" class="input-control" value="<?php echo $s->user_email ?> ">
                    <input type="text" name="alamat" class="input-control" value="<?php echo $s->user_address ?> ">
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        $user_name   = ucwords($_POST['nama']);
                        $username   = $_POST['user'];
                        $user_telp    = $_POST['hp'];
                        $user_email  = $_POST['email'];
                        $user_alamat = ucwords($_POST['alamat']);

                        $update = mysqli_query($conn, "UPDATE tb_user SET
                                user_name = '$user_name',
                                username = '$username',
                                user_telp = '$user_telp',
                                user_email = '$user_email',
                                user_address = '$user_alamat'
                                WHERE user_id = '".$s->user_id."' ");

                        if($update){
                            echo '<script>alert("Ubah data Berhasil")</script>';
                            echo '<script>window.location="profil-user.php"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
                    }
                ?>
            </div>
            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru"  class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru"  class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                <?php
                    if(isset($_POST['ubah_password'])){

                        $pass1   = $_POST['pass1'];
                        $pass2   = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Konfirmasi password tidak sesuai")</script>';
                        }else{

                            $u_pass = mysqli_query($conn, "UPDATE tb_user SET
                                password = '".MD5($pass1)."'
                                WHERE user_id = '".$s->user_id."' ");
                            if($u_pass){
                                echo '<script>alert("Ubah data Berhasil")</script>';
                                echo '<script>window.location="profil-user.php"</script>';
                            }else{
                                echo 'gagal'.mysqli_error($conn);
                            }
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