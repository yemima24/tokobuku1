<?php
session_start();

// digunakan untuk tanda kalau kita menggunakan seson pada halaman ono
// harus diletakkan pada baris pertama 
include("config_buku.php");

// tampung data username dan passwordnya
$username= $_POST["username"];
$password= $_POST["password"];

if(isset($_POST["login_customer"])){
    $sql="select * from customer where username = '$username' and password ='$password'";
    // eksekusi query
    $query = mysqli_query($connect,$sql);
    $jumlah = mysqli_num_rows($query);
    // mysqli_num_rows untuk menghitung adata hasil dari query

    if($jumlah > 0){
        // jika jumlahnya lebih dari 0 artinya terdapat data customer yang sesuai dengan username dan password yang diinputkan
        // ini blok kode jika berhasil
        // kita ubah hasil query ke array
        $customer = mysqli_fetch_array($query);

        // membuat session
        $_SESSION["id_customer"] = $customer["id_customer"];
        $_SESSION["nama"] = $customer["nama"];
        $_SESSION["cart"] = array();

        header("location:list_buku.php");
    }else{
        // jila jumlah 0 artinya tidak ada data customer yang sesuai dengan username dan password yang diinputkan
        // ini blok kode jika loginnya gagal / salah
        header("login:login_customer.php");
        echo $sql;
    }
}

if(isset($_GET["logout"])){
    // menghapus logout
    // menghapus data sesion yang telah dibuat
    session_destroy();
    header("location:login_customer.php");
}
?>