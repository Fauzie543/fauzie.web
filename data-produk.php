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
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">FitWorld</a></h1>
            <ul>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Catalog</a></li>
                <li><a href="data-produk.php">Product</a></li>
                <li><a href="keluar.php">Log Out</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Data Produk</h3>
            <div class="box">
                <p><a href="tambah-produk.php">Tambah Data</a></p>
                <table border="" class="table">
                    <thead>
                        <th width="60px">No</th>
                        <th >Kategori</th>
                        <th >Nama</th>
                        <th >Harga</th>
                        <th >Deskripsi</th>
                        <th >Gambar</th>
                        <th >Status</th>
                        <th width="300px">Keterangan</th>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $produk = mysqli_query($conn, "SELECT * FROM tb_produk LEFT JOIN tb_kategori USING (category_id) ORDER BY product_id DESC");
                            if(mysqli_num_rows($produk) > 0){
                            while($row = mysqli_fetch_array($produk)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                            <td><?php echo $row['product_description'] ?></td>
                            <td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"> 
                            <img src="produk/<?php echo $row['product_image'] ?>" width="60px"> </a></td>
                            <td><?php echo ($row['product_status'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                            <td>
                                <a href="edit-produk.php?id=<?php echo $row['product_id'] ?>">Edit</a> || <a href="hapus-kategori.php?idp=<?php echo $row['product_id'] ?>"onclick="return confirm('Yakin ingin menghapus data ?')">Hapus</a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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