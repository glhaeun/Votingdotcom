<!DOCTYPE html>
<html lang="en">
<?php
    include "../component/php/connect.php";

    if(!isset($_SESSION['from'])){
        header('Location:login.php');
    } else {
        if (($_SESSION['from']) == 'login') {
            if (empty(($_SESSION['l_status']))){
                header("location:login.php");
            } 
        }
    
        if (($_SESSION['from']) == 'register') {
            if (empty(($_SESSION['r_status']))){
                header("location:register.php");
            } 
        }
    }
	
?>
<head>
    <?php require_once("../component/php/head.php"); ?>
    <link rel="stylesheet" href="../component/style/styleOTP.css">
</head>
<body>
    <?php    require_once("../component/php/navbar.php"); ?>
	<main>
		<?php
			if(!empty($error_message)) {
			?>
				<div class="message error_message"><?php echo $error_message; ?></div>
			<?php
				}
				if($_SESSION['from'] == 'register'){		
			?>
					<form action="register.php" method="post">
					<?php 
						if( $_SESSION['r_status'] ==1){

					?>
							<!-- <div class="header"></div> -->
							<h2>KODE OTP</h2>
								<p style="color:#31ab00;">Cek email Anda untuk kode OTP</p>
									
								<div class="input-box">
									<input type="text" name="otp" placeholder="Masukkan Kode OTP" class="box" required>
								</div>
							<!-- <div class="header"></div> -->
							<input type="submit" name="submit_otp" value="Kirim" class="btn">
					<?php 
						} 
						else if ($_SESSION['success'] ==2) {
					?>
                            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                            <script>
                            swal({
                                title: "Berhasil!",
                                text: "Anda berhasil mendaftarkan Akun Anda. Akun Anda akan diverifikasi dalam 24 jam.",
                                icon: "success",
                                
                            }).then(function() {
                                window.location = "login.php";
                            });      
                            </script>   
							<?php
							session_destroy();

						} 
						else if ($_SESSION['success'] == 0) {
							?>
                            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                            <script>
                            swal({
                                title: "Gagal!",
                                text: "Kode verifikasi tidak tepat. Silahkan melakukan registrasi ulang.",
                                icon: "error",
                                
                            });      
                            </script>   
                            <?php
							session_destroy();
							echo '<meta http-equiv="refresh" content="1; URL=register.php">';
						}
							?>
					</form>

		<?php
			} 
			else if ($_SESSION['from']=='login'){
		?>
				<form action="login.php" method="post">
				<?php 
					if( $_SESSION['l_status'] ==1){
				?>
						<!-- <div class="header"></div> -->
						<h2>KODE OTP</h2>
							<p style="color:#31ab00;">Cek email Anda untuk kode OTP</p>
								
							<div class="input-box">
								<input type="text" name="otp" placeholder="Masukkan Kode OTP" class="box" required>
								<!-- class="login-input" -->
							</div>
						<div class="header"><input type="submit" name="submit_otp" value="Kirim" class="btn"></div>
						<!-- class="btnSubmit" -->
				<?php 
					} 
					else if ($_SESSION['l_success'] ==2) {
                        ?>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script>
                        swal({
                            title: "Berhasil!",
                            text: "Anda berhasil masuk!",
                            icon: "success",
                            
                        }).then(function() {
                            window.location = "landing.php";
                        });      
                        </script>   
                        <?php
						unset($_SESSION['l_success']);
						unset($_SESSION['l_status']);
						unset($_SESSION['from']);
					} 
					else if ($_SESSION['l_success'] == 0) {
						?>
                            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                            <script>
                            swal({
                                title: "Gagal!",
                                text: "Kode verifikasi anda salah. Silakan masuk ulang",
                                icon: "error",
                                
                            }).then(function() {
                                window.location = "login.php";
                            });      
                            </script>   
							<?php
							unset($_SESSION['l_success']);
							unset($_SESSION['l_status']);
							unset($_SESSION['from']);
					}
						?>
				</form>

		<?php
			}
		?>
	</main>
</body>
</html>