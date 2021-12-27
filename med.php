<?php 
  require_once "config.php";

  $query = "SELECT * FROM obat";
  $get = mysqli_query($link, $query);
  $geto = mysqli_num_rows($get);
  $con = mysqli_fetch_assoc(mysqli_query($link, $query));
  $ket = $con['keterangan'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/side.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <link href="css/product.css" rel="stylesheet">
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="img/apotek.jpeg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
      <nav class="nav">
        <div> <a href="#" class="nav_logo"> <span class="material-icons">
            health_and_safety
            </span> <span class="nav_logo-name">Apotek Sehat</span> </a>
            <div class="nav_list"> <a href="base.html" class="nav_link "> <span class="material-icons">grid_view </span> <span class="nav_name">Dashboard</span> </a> 
                <a href="med.html" class="nav_link active"> 
                    <span class="material-icons">medication</span></i> <span class="nav_name">Medicine</span> </a> 
                <a href="payment.php" class="nav_link"> 
                    <span class="material-icons">payments</span> <span class="nav_name">Orders</span> </a> 
            </div>
        </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
      </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100" >
      <section class="text-center container" style="padding-top: 30px;"> 
          <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
              <h1 class="fw">Daftar Obat</h1>
              <p class="lead text-muted">pada halaman ini akan terdapat list obat berserta keterangan yang ada</p>
            </div>
          </div>
        </section>
        <div class="album py-5 ">
          <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
              <?php
                for ($i=1; $i <= $geto; $i++) { ?>
                  <div class="col">
                        <div class="card shadow-sm">
                          <img class="bd-placeholder-img card-img-top" src="img/obat/<?php echo $i ?>.jpg" alt="" width="100%" height="225">
              
                          <div class="card-body">
                          <?php
                              $q2 = "SELECT * FROM obat WHERE kode_obat = $i";
                              $c2 = mysqli_fetch_assoc(mysqli_query($link, $q2));
                              $n2 = $c2['nama_obat'];
                              $h2 = $c2['harga_obat'];
                              $ket2 = $c2['keterangan']; 
                              $kat2 = $c2['id_kategori']; 
                            ?>
                            <p class="card-text"><Strong><?php echo $n2 ?></Strong> </p>
                            <p class="card-text">Keterangan : <?php echo $ket2 ?> <br> Harga : <?php echo $h2 ?> </p>
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="btn-group">
                                <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Detail</button> -->
                                <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                              </div>
                              <small class="text-muted">medicine</small>
                            </div>
                          </div>
                        </div>
                      </div>
                <?php }?>
            </div>
          </div>
        </div>


    <script src="js/side.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>