<?php

    include 'koneksi.php';

    if(isset($_GET['idk'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_kategori WHERE category_id = '".$_GET['idk']."' ");
        echo '<script>window.location="data-kategori.php"</script>';
    }

    if(isset($_GET['idp'])){
        $produk = mysqli_query($conn, "SELECT product_image FROM tb_produk WHERE product_id = '".$_GET['idp']."' ");
        $p = mysqli_fetch_object($produk);

        unlink('./produk/'.$p->product_image);

        $delete = mysqli_query($conn, "DELETE FROM tb_produk WHERE product_id = '".$_GET['idp']."' ");
        echo '<script>window.location="data-produk.php"</script>';
    }
?>