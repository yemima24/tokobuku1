<?php
session_start();
if(!isset($_SESSION["id_customer"])){
    header("location:login_customer.php");
}   
// memanggil file config.php agar tidak perlu membuat koneksi baru
include("config_buku.php");
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <style media="screen">
    .header{
      height: 700px;
      background: url("gambar18.jpg") no-repeat;
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
      <h6>CUSTOMER</h6>
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
     <meta charset="utf-8">
     <title>Customer</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/popper.min.js"></script>
     <script src="assets/js/bootstrap.min.js"></script>
     <script type="text/javascript">
       Add = () => {
         document.getElementById('action').value = "insert";
         document.getElementById('id_customer').value = "";
         document.getElementById('nama').value = "";
         document.getElementById('alamat').value = "";
         document.getElementById('kontak').value = "";
         document.getElementById('username').value = "";
         document.getElementById('password').value = "";
       }

       Edit = (item) => {
         document.getElementById('action').value = "update";
         document.getElementById('id_customer').value = item.id_customer;
         document.getElementById('nama').value = item.nama;
         document.getElementById('alamat').value = item.alamat;
         document.getElementById('kontak').value = item.kontak;
         document.getElementById('username').value = item.username;
         document.getElementById('password').value = item.password;
       }
     </script>
   </head>
   <body>
     <?php
     // membuat perintah sql utk menampilkan data siswa
     if (isset($_POST["cari"])) {
       // query jika pencarian
       $cari = $_POST["cari"];
       $sql = " select * from customer where id_customer like '%$cari%' or
       nama like '%$cari%' or alamat like '%$cari%' or kontak like '%$cari%'
       or username like '%$cari%' or password like '%$cari%'";
     }else {
       // query jika tidak mencari
     $sql = " select * from customer";
     }


     // eksekusi perintah sql nya
     $query = mysqli_query($connect, $sql);
   ?>
<div class="container">

  <div class="card">

    <div class="card-header bg-info text-white">
      <h4>customer</h4>
    </div>
    <div class="card-body">
      <form  action="customer.php" method="post">
        <input type="text" name="cari"
        class="form-control" placeholder="pencarian...">
      </form>
      <table class="table" border="1">
        <thead>
            <tr>
              <th>id_customer</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Ussername</th>
              <th>Password</th>
              <th>option</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($query as $customer): ?>
             <tr>
              <td><?php echo $customer["id_customer"];?></td>
              <td><?php echo $customer["nama"]; ?></td>
              <td><?php echo $customer["alamat"]; ?></td>
              <td><?php echo $customer["kontak"]; ?></td>
              <td><?php echo $customer["username"]; ?></td>
              <td><?php echo $customer["password"]; ?></td>


              <td>
                <button data-toggle="modal" data-target="#modal_customer" type="button"
                class="btn btn-sm btn-info" onclick='Edit(<?php echo json_encode($customer);?>)'>
                 Edit </button>
              <a href="proses_customer.php?hapus=true&id_customer=<?php echo $customer["id_customer"];?>"
                onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">
                <button type="button" class="btn btn-sm btn-danger">
                hapus
              </button>
              </a>
              </td>
            <?php endforeach; ?>
          </tr>
        </tbody>
      </table>
      <button data-toggle="modal" data-target="#modal_customer"
      type="button" class="btn btn-sm btn-success" onclick="Add()">
      Tambah Data
    </button>
    </div>
  </div>
  <!-- end card -->

  <!-- form modal -->
  <div class="modal fade" id="modal_customer">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="proses_customer.php" method="post" enctype="multipart/form-data">
        <div class="modal-header bg-danger text-white">
          <h4>Form customer</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="action" id="action">
          id_customer
          <input type="number" name="id_customer" id="id_customer"
          class="form-control" required />
          Nama
          <input type="text" name="nama" id="nama"
          class="form-control" required />
          Alamat
          <input type="text" name="alamat" id="alamat"
          class="form-control" required />
          Kontak
          <input type="text" name="kontak" id="kontak"
          class="form-control" required />
          Ussername
          <input type="text" name="username" id="username"
          class="form-control" required />
          Password
          <input type="text" name="password" id="password"
          class="form-control" required />


      </div>
      <div class="modal-footer">
        <button type="submit" name="save_customer" class="btn btn-primary">
          Simpan</button>
      </div>
      </form>
    </div>

  </div>
  </div>
  <!-- end form modal -->
</div>
   </body>
 </html>