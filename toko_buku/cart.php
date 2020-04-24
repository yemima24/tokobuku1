<?php
session_start();
if (!isset($_SESSION["id_customer"])) {
  header("location:login_customer.php");
}
include("config_buku.php")
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <style media="screen">
    .header{
      height: 700px;
      background: url("gambar13.jpg") no-repeat;
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
      <br />

      <h1>KERANJANG</h1>
     
    </div>
 
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Daftar Buku</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
     <script type="text/javascript.min.js"></script>
     <script type="text/propper.min.js"></script>
     <script type="text/bootstrap.min.js"></script>
     <script type="text/javascript">
       Detail = (item) =>{
         document.getElementById('kode_buku').value = item.kode_buku;
         document.getElementById('judul').innerHTML = item.judul;
         document.getElementById('penulis').innerHTML = item.penulis;
         document.getElementById('harga').innerHTML = item.harga;
         document.getElementById('stok').innerHTML = item.stok;
         document.getElementById('jumlah_beli').value = "1";

         document.getElementById("image").src = "image/" + item.image;
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
     <div class="container">
       <div class="card">
         <div class="card-header bg-info">
           <h4 class="text-white">Keranjang Belanjaan Saya</h4>
         </div>
         <div class="card-body">
           <table class="table">
             <thead>
               <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Option</th>
               </tr>
             </thead>
             <tbody>
               <?php $no = 1; ?>
               <?php foreach ($_SESSION["cart"] as $cart): ?>
               <tr>
                 <td><?php echo $no; ?></td>
                 <td><?php echo $cart["judul"]; ?></td>
                 <td><?php echo $cart["harga"]; ?></td>
                 <td><?php echo $cart["jumlah_beli"]; ?></td>
                 <td><?php echo $cart["jumlah_beli"]*$cart["harga"]; ?></td>
                 <td>
                 <a href="proses_cart.php?hapus=true&kode_buku=<?php echo $cart["kode_buku"]?>">
                 <button type ="button" class="btn btn-sm btn-danger">Hapus</button>
                 </a>
                 
                 </td>
               </tr>
               <?php $no++; endforeach; ?>
             </tbody>
             <tfoot>
              <a href="proses_cart.php?checkout=true">
              <button type ="button" class="btn btn-success">
              Checkout
              </button>
              </a>
             </tfoot>
           </table>
         </div>
       </div>
     </div>
   </body>
 </html>
