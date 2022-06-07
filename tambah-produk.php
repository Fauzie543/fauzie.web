<?php
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
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
    <script src="//cdn.ckeditor.com/4.18.0/basic/ckeditor.js"></script>
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">FitWorld</a></h1>
            <ul>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Catalog</a></li>
                <li><a href="keluar.php">Log Out</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="<?php echo $r['category_id'] ?>">--PILIH--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value=""><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga Produk" required>
                    <input type="file" name="gambar" class="input-control"  required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskrpsi"></textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                      
                       // print_r($_FILES['gambar']);
                       $kategori  = $_POST['kategori'];
                       $nama      = $_POST['nama'];
                       $harga     = $_POST['harga'];
                       $deskripsi = $_POST['deskripsi'];
                       $status    = $_POST['status'];

                       $filename = $_FILES['gambar']['name'];
                       $tmp_name = $_FILES['gambar']['tmp_name'];

                       $type1 = explode('.', $filename);
                       $type2 = $type1[1];

                       $newname = 'produk'.time().'.'.$type2;

                       $type_diizinkan = array('jpg', 'jpeg', 'pnp', 'gif');

                       if(!in_array($type2, $type_diizinkan)){
                           echo '<script>alert("Format file tidak sesuai")</script>';
                       }else{
                           move_uploaded_file($tmp_name, './produk/'.$newname);

                           $insert = mysqli_query($conn, "INSERT INTO tb_produk VALUES (
                                    null, 
                                    '".$kategori."',
                                    '".$nama."',
                                    '".$harga."',
                                    '".$deskripsi."',
                                    '".$newname."',
                                    '".$status."',
                                    null
                                        ) ");

                            if($insert){
                                echo '<script>alert("Tambah data berhasil")</script>';
                                echo '<script>window.location="data-produk.php"</script>';

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
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>