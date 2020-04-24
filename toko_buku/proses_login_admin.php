<?php
session_start();

// digunakan untuk tanda kalau kita menggunakan seson pada halaman ono
// harus diletakkan pada baris pertama 
include("config_buku.php");

// tampung data username dan passwordnya
$username= $_POST["username"];
$password= $_POST["password"];

if(isset($_POST["login_admin"])){
    $sql="select * from admin where username = '$username' and password ='$password'";
    // eksekusi query
    $query = mysqli_query($connect,$sql);
    $jumlah = mysqli_num_rows($query);
    // mysqli_num_rows untuk menghitung adata hasil dari query

    if($jumlah > 0){
        // jika jumlahnya lebih dari 0 artinya terdapat data admin yang sesuai dengan username dan password yang diinputkan
        // ini blok kode jika berhasil
        // kita ubah hasil query ke array
        $admin = mysqli_fetch_array($query);

        // membuat session
        $_SESSION["id_admin"] = $admin["id_admin"];
        $_SESSION["nama"] = $admin["nama"];

        header("location:siswa_buku.php");
    }else{
        // jila jumlah 0 artinya tidak ada data admin yang sesuai dengan username dan password yang diinputkan
        // ini blok kode jika loginnya gagal / salah
        header("location:login_admin.php");
        
    }
     echo $sql;
}

if(isset($_GET["logout"])){
    // menghapus logout
    // menghapus data sesion yang telah dibuat
    session_destroy();
    header("location:login_admin.php");
}
?>