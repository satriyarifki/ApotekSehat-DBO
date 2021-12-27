<?php
// Initialize the session
session_start();
 
require_once "config.php";
 
$query = "SELECT * FROM obat";
$getobat = mysqli_query($link, $query);
$chekk = mysqli_num_rows($getobat);

$firstname = $lastname =  $address =  $kd_obat = $sum = "";
$firstname_err = $kd_obat_err =  $sum_err = "";
$status = "belum sukses"; 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Tolong Masukkan Nama Pemesan.";
    } else{
        $firstname = trim($_POST["firstname"]);
    }
    if(empty(trim($_POST["pilihobat"]))){
        $kd_obat_err = "Pilih obat yang ingin dibeli.";
    } else{
        $kd_obat = trim($_POST["pilihobat"]);
    }
    if(empty(trim($_POST["jumlah"]))){
        $sum_err = "Pilih jumlah obat.";
    } else{
        $sum = trim($_POST["jumlah"]);
    }
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Tolong input Nomor Telepon.";
    } elseif(!preg_match('/^[0-9_]+$/', trim($_POST["phone"]))){
        $phone_err = "Harus berisi angka";
    } elseif(strlen(trim($_POST["phone"])) < 11){
        $phone_err = "Minimal harus tediri dari 11 karakter";
    } else{
        $phone = trim($_POST["phone"]);
    }

    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter your address.";
    } else{
        $address = trim($_POST["address"]);
    }
    $harga = "SELECT nama_obat, harga_obat FROM obat WHERE kode_obat = '$kd_obat'";
    $con = mysqli_fetch_assoc(mysqli_query($link, $harga));
    
    
    if(empty($firstname_err) && empty($address_err) && empty($phone_err)){
        $har = $con['harga_obat'];
        $nam = $con['nama_obat'];
        $total =  (int)$har * (int)$sum;
        $status = "mencoba";
        $id_u = $_SESSION["id_user"];
        $sql = "INSERT INTO pembeli (id_user, nama_pembeli, nohp_pembeli, alamat) VALUES ('$id_u', '$firstname', '$phone', '$address')";
        $idpem = "SELECT id_pembeli FROM pembeli WHERE nama_pembeli = '$firstname'";
        if($stmt = mysqli_query($link, $sql)){
          $ses_pem = $_SESSION["id_pem"] = mysqli_query($link, $idpem);
          $rowpem = mysqli_fetch_assoc($ses_pem);
          $id_pem = $rowpem['id_pembeli']; 
          $sqc = "INSERT INTO transaksi (kode_obat, id_pembeli, jumlah_obat, total_bayar) VALUES( $kd_obat, $id_pem , $sum, $total)";
          if( $stmn = mysqli_query($link, $sqc)){
            $status = "lewat";
          } 
          else {
            echo "Input Error";
          }
            
          
        }
         
    }

    mysqli_close($link);
}
?>
 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/side.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <!-- <link href="/css/product.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/form-validation.css">
</head>
<body id="body-pd" style="padding-bottom: 40px;">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="img/apotek.jpeg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
      <nav class="nav">
        <div> <a href="#" class="nav_logo"> <span class="material-icons">health_and_safety
            </span> <span class="nav_logo-name">Apotek Sehat</span> </a>
            <div class="nav_list"> <a href="base.html" class="nav_link "> <span class="material-icons">grid_view </span> <span class="nav_name">Dashboard</span> </a> 
                <a href="med.php" class="nav_link"> 
                    <span class="material-icons">medication</span></i> <span class="nav_name">Medicine</span> </a> 
                <a href="payment.php" class="nav_link active"> 
                    <span class="material-icons">payments</span> <span class="nav_name">Orders</span> </a> 
            </div>
        </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
      </nav>
    </div>
    <!--Container Main start-->
    <div class="container mb-auto" >
      <div class="py-3"></div>
        <div class="py-5 text-center ">
            <h2>Order form</h2>
            <p class="lead">Halaman Pemesanan</p>
        </div>
        <!-- <?php echo $_SESSION['username']; 
              echo $status;
              echo $firstname;
              echo $id_pem;?> -->
        <div class="d-flex justify-content-center">
        <?php
        if ($status == "lewat") { ?>
          <div class="alert alert-info alert-dissmisable fade show w-50 " role="alert">
            <h4><Strong> Pemesanan Sukses!!!</Strong></h4> <br>
            <h6> Nama Pemesan      :  <?php echo $firstname ?> </h6>
            <h6> Alamat Pemesan    :  <?php echo $address ?> </h6>
            <h6> Obat yang dibeli  :  <?php echo $nam ?> </h6>
            <h6> Jumlah Obat       :  <?php echo $sum?> </h6>
            <h6> Total Harga       : Rp<?php echo $total ?> </h6>
            <hr>
            <p>* Tunggu sekitar 10 menit, pesanan anda akan sampai!</p>
            <hr>
            <button type="button" class="btn-close position-absolute top-0 end-0 p-3" data-bs-dismiss="alert" aria-label="Close" ></button>
          </div>
        <?php } ?>
        </div>
        <div class="container d-flex justify-content-center">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="formpay" >
              <h4 class=" align-items-center mb-3 d-flex justify-content-center">
                <span class="text-primary">Your cart</span>
              </h4>
              <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-center">
                  <div style="width: 400px">
                    <h6 class="my-0">Nama Obat</h6>
                    <Select name="pilihobat" class="form-select <?php echo (!empty($kd_obat_err)) ? 'is-invalid' : ''; ?>">
                      <option disabled selected>Pilih Obat</option>
                      <?php while($row1 = mysqli_fetch_array($getobat)):;?>
                      <option value="<?php echo $row1[0]?>"><?php echo $row1[1];?></option>
                      <?php endwhile;?>
                    </Select>
                    <span class="invalid-feedback"><?php echo $kd_obat_err ?></span>
                    <br>
                    <h6 class="my-0">Jumlah Obat </h6>
                    <Select name="jumlah" class="form-select <?php echo (!empty($sum_err)) ? 'is-invalid' : ''; ?>">
                      <option disabled selected value="">0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </Select>
                    <span class="invalid-feedback"><?php echo $sum_err ?></span>
                  </div>
                </li>
              </ul>
              <div class="col-md-12 col-lg-12">
              <h4 class="mb-3">Billing address</h4>
                <div class="row g-3">
                  <div class="col-sm-12">
                    <label for="firstName" class="form-label">Name</label>
                    <input type="text" class="form-control " name="firstname" id="firstname" placeholder="Masukkan Nama" value="" required>
                    <div class="invalid-feedback">
                      Nama Wajib Dimasukkan
                    </div>
                  </div>
      
                  <div class="col-12">
                    <label for="username" class="form-label">Phone Number</label>
                    <div class="">
                      <input type="text" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" name="phone" id="phone" placeholder="Masukkan Nomor Telepon" required>
                    <div class="invalid-feedback">
                        <?php echo $phone_err ?>
                      </div>
                    </div>
                  </div>
      
                  <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Masukkan Alamat" required>
                    <div class="invalid-feedback">
                      Alamat Wajib Dimasukkan
                    </div>
                  </div>
      
                <hr class="my-4">
      
                <h4 class="mb-3">Payment</h4>
      
                <div class="my-3">
                  <div class="form-check">
                    <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                    <label class="form-check-label" for="credit">Cash On Delivery</label>
                  </div>
                </div>
                <hr class="my-4">
            </div>
            <button class="w-100 btn btn-primary btn-lg" type="submit" >Continue to checkout</button>
            <br>
          </form>
        </div>
         <div class="spacing" style="height: 50px;">

         </div>
      </div>
    
    <script src="js/form-validation.js"></script>
    <script src="js/side.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>