<?php
session_start();
include("config_buku.php");

// menambah barang ke cart 

if(isset($_POST["add_to_card"])){
    // tampung kode buku dan jumlah beli
    $kode_buku = $_POST["kode_buku"];
    $jumlah_beli = $_POST["jumlah_beli"];

    // ambil data buku
    $sql = "select * from buku where kode_buku = '$kode_buku'";
    $query = mysqli_query ($connect , $sql);  //eksekusi sintak sql
    $buku = mysqli_fetch_array($query); //menampung data dari database array

    $item = [
        "kode_buku" => $buku["kode_buku"],
        "judul" => $buku["judul"],
        "image" => $buku["image"],
        "harga" => $buku["harga"],
        "jumlah_beli" => $jumlah_beli
    ];

    // masukkan item e keranjang(cart)
    array_push($_SESSION["cart"], $item);

    header("location:list_buku.php");
}

// untuk menghapus item pada cart
if(isset($_GET["hapus"])){
    // tampung data kose_buku yang dihapus
    $kode_buku =$_GET["kode_buku"];

    // cari index cart sesuai dengan kode buku yang dihapus
    $index = array_search(
        $kode_buku,array_column(
            $_SESSION["cart"],"kode_buku"
        )
    );

    // hapus item pada cart
    array_splice($_SESSION["cart"], $index, 1);
    header("location:cart.php");

}

// checkout
if (isset($_GET["checkout"])) {
    // memasukkan data pada cart ke data base (table transaksi dan detail transaksi)
    // transaksi -> id transaksi ,tanggal, id_customer
    // detail-> id transaksi,kode buku,jumlah,harga beli

    $id_transaksi = "ID".rand(1,10000);
    // $tgl = date("y-m-d  H:i:s");current time (saat ini)
    // y = years, m = mount, d = day, h = hours, i = miniutes, s = second
    $id_customer =$_SESSION["id_customer"];

    // buat query ke tabel transaksi
    $sql = "insert into transaksi values ('$id_transaksi','$tgl','$id_customer')";
     mysqli_query($connect,$sql); //eksekusi query

    foreach ($_SESSION["cart"] as $cart){
        $kode_buku = $cart["kode_buku"];
        $jumlah = $cart ["jumlah_beli"];
        $harga_beli = $cart["harga"];

        // insert ke table detail
        $sql ="insert into detail_transaksi values (
        '$id_transaksi','$kode_buku','$jumlah','$harga_beli'
        )";
        mysqli_query($connect,$sql);

        $sql2 = "update buku set stok = stok - $jumlah where kode_buku = '$kode_buku'";
        mysqli_query($connect, $sql2);
    } 
    // kosongkan cart nya
    $_SESSION["cart"] = array();
    header("location:transaksi.php");
}
?>