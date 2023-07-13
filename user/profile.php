<?php 
include '../component/php/connect.php';

    if(isset($_POST['cancel_profile']) || isset($_POST['cancel_password'])){
        header('location:landing.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
    
<head>
    <title>Voting.com</title>
    <?php require_once("../component/php/head.php"); ?>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>
body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: #333;
  background-color: #f2f2f2;

}

/* Section styles */
.section {
  padding-top: 5rem;
  padding-bottom: 5rem;
}

.py-5 {
  padding-top: 3rem !important;
  padding-bottom: 3rem !important;
}

.my-5 {
  margin-top: 3rem !important;
  margin-bottom: 3rem !important;
}

/* Container styles */
.container {
  width: 100%;
  max-width: 1200px;
  margin-right: auto;
  margin-left: auto;
  padding-right: 15px;
  padding-left: 15px;
}

h1,
h3 {
  margin-top: 0;
  margin-bottom: 1rem;
  color: #BB0C0C;
}


/* Background styles */
.bg-white {
  background-color: #fff !important;
}

/* Shadow styles */
.shadow-red {
  box-shadow: 4px 4px 4px rgba(187, 12, 12, 0.5);
}

/* Rounded styles */
.rounded-lg {
  border-radius: 0.3rem;
}

/* Profile tab navigation styles */
.profile-tab-nav {
  border-right: 1px solid #833535;
}

.p-4 {
  padding: 1rem !important;
}

.img-circle {
  border-radius: 50%;
}

.mb-3 {
  margin-bottom: 1rem !important;
}

.text-center {
  text-align: center !important;
}

.profile-tab-nav h4 {
  margin-bottom: 0;
}

.nav-pills {
  display: flex;
  flex-direction: column;
}

.nav-link {
  display: flex;
  align-items: center;
  color: #333;
  text-decoration: none;
  padding: 0.5rem;
  transition: background-color 0.3s;
}

.nav-link.active,
.nav-link:focus {
  background-color: #ffffff;
}

.nav-link i {
  margin-right: 0.5rem;
}

.tab-content {
  padding: 1rem !important;
}

.p-md-5 {
  padding: 3rem !important;
}

.tab-pane {
  display: none;
}

.tab-pane.fade.show.active {
  display: block;
}

/* Form styles */
.form-group {
  margin-bottom: 1.5rem;
}

.form-control {
  display: block;
  width: 100%;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  /* border: 1px solid #ea2167; */
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn {
  display: inline-block;
  font-weight: 400;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  user-select: none;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  transition: all 0.15s ease-in-out;
}

.btn-primary {
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  color: #fff;
  background-color: #0069d9;
  border-color: #0062cc;
}

.btn-light {
  color: #212529;
  background-color: #f8f9fa;
  border-color: #f8f9fa;
}

.btn-light:hover {
  color: #212529;
  background-color: #e2e6ea;
  border-color: #dae0e5;
}

/* Checkbox styles */
.form-check {
  position: relative;
  display: block;
  padding-left: 1.25rem;
}

.form-check-input {
  position: absolute;
  margin-top: 0.25rem;
  margin-left: -1.25rem;
}

.btn-primary, .nav-link.active {
  background-color:#BB0C0C !important;
  border: none;
}

</style>
<body>
<?php require("../component/php/navbar.php"); 
include '../component/php/profile.php';
include '../component/php/surat_upload.php';
?>

    <?php
        $user_id = $_SESSION['user_id'];

        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $get_userdata = $connect->prepare($query);
        $get_userdata -> execute();

        $fetch_userdata = $get_userdata -> fetch(PDO::FETCH_ASSOC);
        $user_nama = $fetch_userdata['nama'];
        $email = $fetch_userdata['email'];
        $nomor = $fetch_userdata['nomor'];
        $NIK = $fetch_userdata['NIK'];
    ?>

    <section class="py-5">
		<div class="container">
			<h1 class="mb-3">Pengaturan Akun</h1>
			<div class="bg-white shadow-red rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">
					<div class="p-4">
						<div class="img-circle text-center">
                        <i class="fa fa-user" style="color:#BB0C0C;"></i>
						</div>
						<h5 class="text-center">Hai,<?=$user_nama?> </h5>
					</div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i> 
							Akun
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Kata Sandi
						</a>
            <a class="nav-link" id="change_name-tab" data-toggle="pill" href="#change_name" role="tab" aria-controls="change_name" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Ganti Nama
						</a>
					</div>
				</div>
				<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
						<h3 class="mb-4">Perubahan Data Akun</h3>
                        <form action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Nama</label>
								  	<input id="nama" name="nama" type="text" class="form-control" value="<?=$user_name?>">
                                    <span class="error" id="err_nama"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Email</label>
								  	<input id="email" name="email" type="text" class="form-control" value="<?=$email?>">
                    <span class="error" id="err_email"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Nomor telepon</label>
								  	<input id="nomor" name="nomor" type="text" class="form-control" value="<?=$nomor?>">
                                    <span class="error" id="err_nomor"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>NIK</label>
								  	<input id="NIK" name="NIK" type="text" class="form-control" value="<?=$NIK?>">
                                   <span class="error" id="err_NIK"></span>
								</div>
							</div>
						</div>
						<div>
                            <input id="submit" type="submit" value="Ubah" name="update_profile" class="btn btn-primary">
							<input type="submit" value="Batal" name="cancel_profile" class="btn btn-light">
						</div>
                    </form>
                    </div>
					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<h3 class="mb-4">Perubahan Kata Sandi</h3>
                        <form action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Kata Sandi Lama</label>
								  	<input type="password" class="form-control" name="current">
								</div>
                            </div>
						</div>
                        <div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Kata Sandi Baru</label>
								  	<input type="password" class="form-control" name="password">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Konfirmasi Kata Sandi Baru</label>
								  	<input type="password" class="form-control" name="cpassword">
								</div>
							</div>
						</div>
						<div>
							<input id="submit" type="submit" value="Ubah" name="update_password" class="btn btn-primary">
							<input type="submit" value="Batal" name="cancel_password" class="btn btn-light">
						</div>
                        </form>
            </div>
            <div class="tab-pane fade" id="change_name" role="tabpanel" aria-labelledby="change_name-tab">
						<h3 class="mb-4">Perubahan Kata Sandi</h3>
            <form action="../component/php/download.php" method="POST">
						<div class="row">
								<div class="form-group">
								  	<label>Mengunduh Surat Permohonan Pergantian Nama</label>
                    <input type="submit" name="download_template" value="Download Template">
								</div>
						</div>
            </form>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Nama Baru Anda</label>
								  	<input type="text" class="form-control" name="nama_baru">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
                <label>Surat Permohonan Anda</label>
                <input type="file" name="docx_file" accept=".pdf">
                </div>
							</div>
						</div>
						<div>
							<input id="submit" type="submit" value="Kirim" name="kirim_surat" class="btn btn-primary">
							<input type="submit" value="Batal" name="cancel_nama" class="btn btn-light">
						</div>
            </form>
            </div>
				</div>
			</div>
		</div>
	</section>

    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        function checkuser() {
            var pattern = /^[a-zA-Z-' ]*$/;
            var user = $('#nama').val();
            var validuser = pattern.test(user);
            if (user == "") {
                $('#err_nama').html('nama tidak boleh kosong');
                return false;
            } else if ($('#nama').val().length < 4) {
                $('#err_nama').html('panjang karakter nama terlalu pendek');
                return false;
            } else if (!validuser) {
                $('#err_nama').html('karakter nama hanya boleh a-z atau A-Z');
                return false;
            } else {
                $('#err_nama').html('');
                return true;
            }
        }

        function checkemail() {
            var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $('#email').val();
            var validemail = pattern1.test(email);
            if (email == "") {
                $('#err_email').html('email tidak boleh kosong');
                return false;
            } else if (!validemail) {
                $('#err_email').html('invalid email');
                return false;
            } else {
                $('#err_email').html('');
                return true;
            }
        }

        function checknomor() {
            var pattern3 = /^08[1-9][0-9]{7,10}$/;
            var nomor = $('#nomor').val();
            var validnomor = pattern3.test(nomor);

            if (nomor == "") {
                $('#err_nomor').html('nomor telepon tidak boleh kosong');
                return false;
            } else if (!$.isNumeric(nomor)) {
                $("#err_nomor").html("hanya boleh angka");
                return false;
            } else if (!validnomor) {
                $("#err_nomor").html("nomor telepon harus dimulai dengan 08xx dan terdiri dari 7-10 digit");
                return false;
            }
            else {
                $("#err_nomor").html("");
                return true;
            }
        }

        function checkNIK() {
            if ($("#NIK") == "") {
                $('#err_NIK').html('NIK tidak boleh kosong');
                return false;
            } else if (!$.isNumeric($("#NIK").val())) {
                $("#err_NIK").html("hanya boleh angka");
                return false;
            } else if ($("#NIK").val().length != 13) {
                $("#err_NIK").html("harus berisi 13 angka");
                return false;
            }
            else {
                $("#err_NIK").html("");
                return true;
            }
        }


        $(document).ready(function () {
            $('#nama').on('input', function () {
                checkuser();
            });
            $('#nomor').on('input', function () {
                checknomor();
            });
            $('#email').on('input', function () {
                checkemail();
            });
            $('#NIK').on('input', function () {
                checkNIK();
            });
            
            $('#submit').click(function () {

                
                if (!checkuser() && !checkNIK() && !checknomor() && !checkemail()) {
                    $("#mssg").html(`<div class="alert alert-warning">Tolong isi semua input</div>`);
                    return false;
                } else if (!checkuser() ||!checkNIK() || !checknomor() || !checkemail()) {
                    $("#mssg").html(`<div class="alert alert-warning">Invalid input, tolong cek kembali!</div>`);
                    return false;
                } 
            });

        });

    </script>

    
   
</body>
</html>
