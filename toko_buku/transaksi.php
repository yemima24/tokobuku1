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
      background: url("gambar14.jpg") no-repeat;
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
      <h1>RIWAYAT</h1>
      <h6>TRANSAKSI</h6>
     
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
    <div class= "card-mt-3">
      <div class="card-header bg-secondary">
      <h4 class="text-white">Riwayat Transaksi</h4>
      </div>
      <div class="card-body">
      <?php
      $sql = "select * from transaksi t inner join customer c 
      on t.id_customer = c.id_customer 
      where t.id_customer = '".$_SESSION["id_customer"]."' order by t.tgl desc";
      
      $query = mysqli_query($connect,$sql);
      ?>

      <ul class="list-group">
       <?php foreach ($query as $transaksi): ?>
       <li class = "list-group-item mb-4">
         <h6>ID Transaksi : <?php echo $transaksi["id_transaksi"]; ?></h6>
         <h6>Pembeli : <?php echo $transaksi["nama"];?></h6>
         <h6>Tgl.Transaksi : <?php echo $transaksi["tgl"];?></h6>
         <h6>List Barang</h6>

         <?php
         $sql2 ="select * from detail_transaksi d inner join buku b 
         on d.kode_buku = b.kode_buku 
         where d.id_transaksi = '".$transaksi["id_transaksi"]."'";
         
         $query2 = mysqli_query($connect, $sql2);
         ?>

         <table class="table table-borrderless">
         <thead>
         <tr>
          <th>Judul</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
         </tr>
         </thead>
         <tbody>
         <?php $total =0; foreach ($query2 as $detail):?>
         <tr>
         <td><?php echo $detail["judul"];?></td>
         <td><?php echo $detail["jumlah"];?></td>
         <td><?php echo number_format($detail["harga_beli"]);?></td>
         <td>
          Rp <?php echo number_format($detail["harga_beli"]*$detail["jumlah"]);?>
         </td>
         </tr>
         <?php
         $total += ($detail["harga_beli"]*$detail["jumlah"]);
         endforeach;?>
         </tbody>
         </table>
        <h6 class = "text danger" >Rp <?php echo number_format ($total);?></h6>
        </li>
       <?php endforeach;?>     
      </ul>
      </div>
    </div>
   </div>
   </body>
 </html>