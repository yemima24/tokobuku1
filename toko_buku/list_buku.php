<?php
session_start();
if(!isset($_SESSION["id_customer"])){
    header("location:login_customer.php");
}
include("config_buku.php");
?>  

<!DOCTYPE html>
<html lang="en" >
<style media="screen">
    .header{
      height: 700px;
      background: url("gambar5.jpg") no-repeat;
      text-align: center;
      background-size: cover;
      align-content: center;
      background-position: center;
      box-shadow: inset 0 0 0 500px rgba(0, 0, 0, 0.5);
      text-decoration-color:white;
    }

    .header h1{
      color:white;
    }
    .header h6{
        color:white;
    }
    
  </style>
  </head>
  <body>

    <div class="header col-12">
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <h1>LIST PENJUALAN</h1>
      <h6>BUKU</h6>
     
    </div>
<head>
    <meta charset="UTF-8">
    <title>Toko Buku</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        Detail = (item) => {
            document.getElementById('kode_buku').value = item.kode_buku;
            document.getElementById('judul').innerHTML = item.judul;
            document.getElementById('penulis').innerHTML = "penulis: " + item.penulis;
            document.getElementById('harga').innerHTML = "harga: " + item.harga;
            document.getElementById('stok').innerHTML = "stok: " + item.stok;
            document.getElementById('jumlah_beli').value = "1";
            document.getElementById('jumlah_beli').max = item.stok;


            document.getElementById('image').src = "image/" + item.image;
        }
    </script>

</head>
<body>
<nav class="navbar navbar-expand-md bg-info navbar-dark fixed-top">
           

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
                <span class="navbar navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav">
                        <li class ="nav-item">
                        <a href="cart.php" class="nav-link">
                        Cart(<?php echo count ($_SESSION["cart"]); ?>)
                        </a>
                        </li>

                        <li class="nav-item"><a href="siswa_buku.php" class="nav-link">Buku</a></li>
                        <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
                        <li class="nav-item"><a href="customer.php" class="nav-link">Customer</a></li>  
                        <li class="nav-item"><a href="list_buku.php" class="nav-link">List Buku</a></li>  
                        <li class="nav-item"><a href="cart.php" class="nav-link">Keranjang</a></li>                     
                    </ul>
            </div>
    </nav>    
      <?php
      if(isset($_POST["cari"])){
        //query jika mencari
        $cari = $_POST["cari"];
        $sql = "select * from buku where kode_buku like '%$cari%' or judul like '%$cari%' or penulis like '%$cari%' or tahun like '%$cari%' or harga like '%$cari%' or stok like '%$cari'";
      }else {
        //query jika tidak mencari
        $sql = "select * from buku";
      }
      //eksekusi perintah SQL-nya
      $query = mysqli_query($connect,$sql);
      ?>

     <div class="row">
     <?php foreach ($query as $buku):?>
     <div class= "card col-4">
     <div class="card-body">
     <img src="image/<?php echo $buku ["image"];?>" width ="150">
     <h5 class="text-success"><?php echo $buku ["judul"];?></h5>
     <h6 class="text-secondary">Rp <?php echo $buku["harga"]; ?></h6>
     </div>
     <div class="card-footer">
     <button type="button" class="btn btn-sm btn-info"
     onclick='Detail(<?php echo json_encode($buku); ?>)'
     data-toggle="modal" data-target="#modal_detail">
     Detail
     </button>
     </div>
     </div>
     <?php endforeach; ?>
     </div>

     <div class="modal" id="modal_detail">
     <div class="modal-dialog">
     <div class="modal-content">
     <div class="modal-header bg dark">
     <h4 class="text-white">Detail Buku</h4>
     </div>
     <div class="modal-body">
     <div class="row">
     <div class="col-6">
     <!-- gambar -->
     <img style="width:100%; height: auto;" id ="image">
     </div>
     <div class="col-6">
     <!-- deskripsi -->
     <h4 id="judul"></h4>
     <h4 id="penulis"></h4>
     <h4 id="harga"></h4>
     <h4 id="stok"></h4>

     <form action="proses_cart.php" method="post">
     <input type="hidden" name="kode_buku" id="kode_buku">
     Jumlah Beli
     <input type="number" name="jumlah_beli" id="jumlah_beli"
     class="form-control" min="1">
     <button type="submit" name="add_to_card" class="btn btn-success">
     Tambah Ke Keranjang
     </button>
     </form>
     </div>
     </div>
     </div>
     </div>
     </div>
     </div>
</head>
  </body>
</html>

   