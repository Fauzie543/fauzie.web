<?php
    include 'koneksi.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
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
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
                <li><a href="profil-user.php"><i class="fa fa-user"></i></a></li>
            </ul>
        </div>
        <img src="img/logo.png" class = "menu1" onclick="togglemenu()">
    </nav>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Search Product">
                <input type="submit" name="cari" value="Search">
            </form>
        </div>
    </div>

    <!-- category --->
    <div class="section">
        <div class="container">
            <h3>Category</h3>
            <div class="box">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                ?>
                    <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                        <div class="col-5">
                            <img src="img/icon.jpg" width="40px">
                            <p><?php echo $k['category_name'] ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>    
            </div>
        </div>
    </div>
    <!-- new product -->
    <div class="section">
        <div class="container">
            <h3>New Product</h3>
            <div class="box">
                <?php
                $produk = mysqli_query($conn, "SELECT * FROM tb_produk WHERE product_status = 1 ORDER BY  product_id  DESC LIMIT 4");
                if(mysqli_num_rows($produk) > 0){
                    while($p = mysqli_fetch_array($produk)){
                ?>
                    <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                        <div class="col-4" data-aos="flip-right" data-aos-duration="1500">
                            <img src="produk/<?php echo $p['product_image'] ?>">
                            <p class="nama"><?php echo $p['product_name'] ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Produk tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>

            <h4>No Telp</h4>
            <p><?php echo $a->admin_telp ?></p>
            
            <small>Copyright &copy; 2022 - FitWorld</small>
        </div>

    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>