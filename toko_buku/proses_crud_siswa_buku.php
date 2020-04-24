<?php
include ("config_buku.php");
var_dump($_POST);
if (isset($_POST["save_buku"])) {
    // isset digunakan untuk mengecek
    // apakah ketika mengirim file ini
    // data "save_siswa" dengan method POST

    // kita tampung data yang dikirimkan
    $action = $_POST ["action"];
    $kode_buku = $_POST ["kode_buku"];
    $judul = $_POST ["judul"];
    $penulis = $_POST ["penulis"];
    $tahun = $_POST["tahun"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    

    // menampung file image
    if(!empty($_FILES["image"]["name"])){
        $path = pathinfo($_FILES["image"]["name"]);
        // mrngamnbil ekstensi pada gambar
        $extension = $path["extension"];

        // rangkai file nama-nya
        $filename = $kode_buku."-".rand(1,1000).".".$extension;
        // generate nama file
        // exp : 111-98.JPG
        // rand() random nilai 1 - 10000
    }


    // cek aksi nya
    if($action == "insert"){
        // sintak untuk insert
        $sql = "insert into buku values ('$kode_buku','$judul','$penulis','$tahun','$harga','$stok','$filename')";

        // proses upload file 
        move_uploaded_file($_FILES["image"]["tmp_name"],"image/$filename");
        echo $sql;
        // eksekusi perintah SQL nya
        mysqli_query($connect, $sql);
    }else if ($action == "update"){
        if(!empty($_FILES["image"]["name"])){
            $path = pathinfo($_FILES["image"]["name"]);
            // mengambil ekstensi pada gambar
            $extension = $path["extension"];

            // rangkai file nama-nya
            $filename = $kode_buku."-".rand(1,1000).".".$extension;
            // generate nama file
            // exp : 111-98.JPG
            // rand() random nilai 1 - 10000

            
        // ambil data yang akan di edit
        $sql = "select * from buku where kode_buku= '$kode_buku'";
        $query = mysqli_query($connect,$sql);
        $hasil = mysqli_fetch_array($query);

        if (file_exists("image/".$hasil["image"])){
            unlink("image/".$hasil["image"]);
            // mengapus gambar yang terdahulu
        }
            
        


         // upload gambar-nya
         move_uploaded_file($_FILES["image"]["tmp_name"],"image/".$filename);
         // sintak untuk update
         // dibenahin yem
         $sql = "update buku set judul = '$judul',
         penulis='$penulis',harga='$harga',tahun = '$tahun', image = '$filename' where kode_buku = '$kode_buku'";
        } 
         else{
         $sql = "update buku set judul = '$judul',
         penulis='$penulis',harga='$harga',tahun = '$tahun' where kode_buku = '$kode_buku'";
        }
    
        echo $sql;
        // eksekusi perintah SQL nya
        mysqli_query($connect, $sql);
    }
    
    // redirect ke halama siswa.php
    header("location:siswa_buku.php");
}

if(isset($_GET["hapus"])){
    $kode_buku = $_GET["kode_buku"];
    $sql = "select * from buku where kode_buku='$kode_buku'";
    $query = mysqli_query($connect,$sql);
    $hasil = mysqli_fetch_array($query);
    if (file_exists("image/",$hasil["image"])){
        unlink ("image/".$hasil["image"]);
    }
    $sql = " delete from buku where kode_buku ='$kode_buku'";


    
    mysqli_query($connect,$sql);

    // dirrest ke halaman buku
    header ("location:siswa_buku.php");
}
?>