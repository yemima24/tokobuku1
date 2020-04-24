<?php
session_start();
if(!isset($_SESSION["id_admin"])){
    header("location:login_admin.php");
}
// ini include nak ke config_buku.php
include("config_buku.php");
?>

<!DOCTYPE html>
<html lang="en" >
    

    <style media="screen">
    .header{
      height: 700px;
      background: url("gambar15.jpg") no-repeat;
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
     
      <h1>PENGISIAN DATA</h1>
      <h6>BUKU</h6>
    </div>
<head>
<nav class="navbar navbar-expand-md bg-info navbar-dark fixed-top">
           

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
                <span class="navbar navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav">
                        
                        <li class="nav-item"><a href="siswa_buku.php" class="nav-link">Buku</a></li>
                        <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
                        <li class="nav-item"><a href="customer.php" class="nav-link">Customer</a></li>        
                        <li class="nav-item"><a href="list_buku.php" class="nav-link">List Buku</a></li>      
                        <li class="nav-item"><a href="cart.php" class="nav-link">Keranjang</a></li>   
                                       
                    </ul>
            </div>
        </nav>    
    <meta charset="UTF-8">
    <title>Toko Buku Bos</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        Add = () => {
            document.getElementById('action').value = "insert";
            document.getElementById('kode_buku').value = "";
            document.getElementById('judul').value = "";
            document.getElementById('penulis').value = "";
            document.getElementById('tahun').value = "";
            document.getElementById('harga').value = "";
            document.getElementById('stok').value = "";
            document.getElementById('image').value = "";
            
        }

        Edit = (item) =>{
            document.getElementById('action').value = "update";
            document.getElementById('kode_buku').value = item.kode_buku; //lanjutkan yem
            document.getElementById('judul').value = item.judul;
            document.getElementById('penulis').value = item.penulis;
            document.getElementById('tahun').value = item.tahun;
            document.getElementById('harga').value = item.harga;
            document.getElementById('stok').value = item.stok;
        }
    </script>

</head>
<body>
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
    <div class="container">
            <!-- start card -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>Data Customer</h4>
                </div>
                <div class="card-body">
                    <form action="siswa_buku.php" method="post">
                        <input type="text" name="cari" class="form-control" placeholder="Pencarian...">
                    </form>
                    <table class="table" border="1">
                        <thead>
                          <tr>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Image</th>
                            <th>Opsi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($query as $siswa_buku): ?>
                            <tr>
                                <td><?php echo $siswa_buku["kode_buku"] ?></td>
                                <td><?php echo $siswa_buku["judul"] ?></td>
                                <td><?php echo $siswa_buku["penulis"] ?></td>
                                <td><?php echo $siswa_buku["tahun"] ?></td>
                                <td><?php echo $siswa_buku["harga"] ?></td>
                                <td><?php echo $siswa_buku["stok"] ?></td>
                                <!-- cinta kan membawamu, kembali disini -->
                                <td>
                                    <img src="<?php echo 'image/'.$siswa_buku['image'];?>" alt="Foto Buku" width="200" />
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#modal_siswa" type="button" class="btn btn-sm btn-info" onclick='Edit(<?php echo json_encode($siswa_buku);?>)'> Edit</button>
                                    <a href="proses_crud_siswa_buku.php?hapus=true&kode_buku=<?php echo $siswa_buku["kode_buku"];?>" onclick="return confirm('Yakin Untuk Mengapus Data Ini?')">
                                        <button type="button" class="btn btn-sm btn-danger">Hapus Aja</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
            <button data-toggle="modal" data-target="#modal_siswa" type="button" class="btn btn-sm btn-success" onclick="Add()">Tambah Data</button>
                </div>
            </div>
        <!-- end card -->
        <!-- form modal -->
        <div class="modal fade" id="modal_siswa">
            <div class="modal-dialog">
                <div class="modal-content">
                <form action="proses_crud_siswa_buku.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header bg-danger text-white">
                        <h4>Form Buku</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" id="action">
                        KODE BUKU
                        <input type="number" name="kode_buku" id="kode_buku" class="form-control" required />
                        Judul
                        <input type="text" name="judul" id="judul" class="form-control" required />
                        Penulis
                        <input type="text" name="penulis" id="penulis" class="form-control" required />
                        Tahun
                        <input type="text" name="tahun" id="tahun" required>
                        Harga
                        <input type="text" name="harga" id="harga" class="form-control" required/>
                        Stok
                        <input type="text" name= "stok" id="stok" class="from-control" required/>
                        Foto 
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="save_buku" class="btn btn-primary">Simpan</button>
                    </div>
                </form> 
                </div>
            </div>
        </div>
        <!-- end modal -->
    </div>
</body>
</html>