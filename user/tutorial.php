<!DOCTYPE html>
<html>
<?php
    include "../component/php/connect.php"; 
    require_once("../component/php/navbar.php"); ?>
<?php require_once("../component/php/head.php"); ?>

<link rel="stylesheet" href="../component/style/styleTutorial.css">

<body>
  <div id="tutorial" class="container">
    <h1>How Does It Work?</h1>
    
    <div class="steps-container">
    <div class="row">
        <div class="step">
          <div class="step-icon"><i class="fas fa-regular fa-file-pen"></i></div>
          <h2 class="step-title">Step 1</h2>
          <p class="step-description">Mohon memasukkan data yang sesuai dengan data yang valid.</p>
        </div>
        
        <div class="step">
          <div class="step-icon"><i class="fas fa-solid fa-check"></i></i></div>
          <h2 class="step-title">Step 2</h2>
          <p class="step-description">Setelah selesai, mohon menverifikasikan akun Anda dengan OTP yang dikirimkan ke alamat email anda.</p>
        </div>
        
        <div class="step">
          <div class="step-icon"><i class="fas fa-solid fa-right-to-bracket"></i></div>
          <h2 class="step-title">Step 3</h2>
          <p class="step-description">Setelah selesai Verifikasi, Anda harus masuk ulang dengan data yang sudah didaftarkan sebelumnya.</p>
        </div>
        
        <div class="step">
          <div class="step-icon"><i class="fas fa-solid fa-house"></i></div>
          <h2 class="step-title">Step 4</h2>
          <p class="step-description">Halaman utama akan muncul ketika proses masuk sudah berhasil.</p>
        </div>
      </div>
      
      <div class="row">
        <div class="step">
          <div class="step-icon"><i class="fas fa-solid fa-check-to-slot"></i></div>
          <h2 class="step-title">Step 5</h2>
          <p class="step-description">Mohon mengklik tombol vote now untuk mengikuti voting.</p>
        </div>
        
        <div class="step">
          <div class="step-icon"><i class="fas fa-sharp fa-solid fa-filter"></i></div>
          <h2 class="step-title">Step 6</h2>
          <p class="step-description">Mohon memilih kategori tingkatan yang sedang diselenggarakan.</p>
        </div>
        
        <div class="step">
          <div class="step-icon"><i class="fas fa-solid fa-people-group"></i></div>
          <h2 class="step-title">Step 7</h2>
          <p class="step-description">Pilih kandidat yang ingin anda pilih. </p>
        </div>
        
        <div class="step">
          <div class="step-icon"><i class="fas fa-sharp fa-solid fa-check-double"></i></div>
          <h2 class="step-title">Step 8</h2>
          <p class="step-description">Proses voting anda sudah selesai.</p>
        </div>
      </div>
    </div>
  </div>

  <?php include '../component/php/footer.php';?>
</body>
</html>