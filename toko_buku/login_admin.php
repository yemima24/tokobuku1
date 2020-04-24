<?php
include("config_buku.php");
?>

<html lang="en"><style media="screen">

    .header{
      height: 700px;
      background: url("gambar20.jpg") no-repeat;
      text-align: center;
      background-size: cover;
      align-content: center;
      background-position: center;
      box-shadow: inset 0 0 0 700px rgba(0, 0, 0, 0);
      text-decoration-color:black;
    }   
    .header h1{
        color:secondary;
    }
  </style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
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
      
      
      <h1>Toko Buku Bos</h1>
      
      <div class="container">
   <div class="card">
   <div class="card-header">
   <h4>Login Admin</h4>
   </div>
   <div class="card-body">
    <form action="proses_login_admin.php" method="post">
    USERNAME
    <input type ="text" name="username" class="form-control" required/>
    PASSWORD
    <input type ="password" name="password" class="form-control" required/>
    <button type ="submit" name="login_admin" class="btn btn-block btn-primary">
    -----Login-----
    </button>
   </form>
   </div>
   </div>
   </div>
    </div>
</body>
</html>