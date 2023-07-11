<!DOCTYPE html>
<html lang="en">
<?php
    include "../component/php/connect.php";
?>

<?php
    include '../component/php/sendemail.php';
    $_SESSION['r_status'] = 0;
    $_SESSION['success'] = 1;
    $tempDirectory = 'temp_images/';


    

    if (isset($_POST['register'])){
        
        $_SESSION['data']['nama'] = $nama = $_POST['nama'];
        $_SESSION['data']['email'] = $email = htmlspecialchars(trim($_POST['email']));
        $_SESSION['data']['password'] = $pass = htmlspecialchars(trim($_POST['password']));
        $_SESSION['data']['nomor'] = $nomor = htmlspecialchars(trim($_POST['nomor']));
        $_SESSION['data']['NIK'] = $NIK = htmlspecialchars(trim($_POST['NIK']));

        //kt simpan filenya di folder sementara dulu cuz klo gk imgnya hilang
        // yg tersimpan di session nnti cuman string bukan imgnya sendiri --> error td karena ini wkwk

        

        $select_users = $connect->prepare("SELECT * FROM users WHERE email = ? ");
        $select_users -> execute([$email]);

        $select_users1 = $connect->prepare("SELECT * FROM users WHERE nomor = ? ");
        $select_users1 -> execute([$nomor]);

        $select_users2 = $connect->prepare("SELECT * FROM users WHERE NIK = ? ");
        $select_users2 -> execute([$NIK]);

        if (empty($nama) || empty($email) || empty($pass) || empty($nomor) || empty($NIK)) {
            $message[]= 'Tolong isi semua data';
        } else {

            if($select_users2-> rowCount() > 0 ) {
             $message[]='NIK ini sudah teregistrasi';
            }else if($select_users-> rowCount() > 0) {
                $message[]= 'Email ini sudah teregistrasi';
            } else if ($select_users1 -> rowCount() > 0) {
                $message[]= 'Nomor ini sudah teregistrasi';
            } else {

            if (!file_exists($tempDirectory)) {
                mkdir($tempDirectory, 0777, true);
            }

                $tempFilePath = $_FILES['fotoKTP']['tmp_name'];
                $_SESSION['nama_foto_KTP'] = $NIK."_fotoKTP_".$_FILES['fotoKTP']['name'];
                $targetFilePath = $tempDirectory.$_SESSION['nama_foto_KTP'];

                $tempFilePath_fotoWajah = $_FILES['fotoWajah']['tmp_name'];
                $_SESSION['nama_foto_Wajah'] = $NIK."_fotoWajah_".$_FILES['fotoWajah']['name'];
                $targetFilePath_fotoWajah = $tempDirectory.$_SESSION['nama_foto_Wajah'];
 

                move_uploaded_file($tempFilePath, $targetFilePath);
                move_uploaded_file($tempFilePath_fotoWajah, $targetFilePath_fotoWajah);

                $otp = rand(100000,999999);
                sendOTP($_POST["email"],$otp);
                $query = "INSERT INTO otp_expiry(otp,is_expired,create_at,email) VALUES ('" . $otp . "', 0, '" . date("Y-m-d H:i:s"). "', '" . $email . "')";
                $insert_otp = $connect -> prepare($query);
                $insert_otp -> execute();     
                $_SESSION['from']='register'; 
                $_SESSION['r_status']=1;
                header("location:OTP.php");
            }
        }
       ;
    }

    
    if(isset($_POST['submit_otp'])) {
        $nama = $_SESSION['data']['nama'] ;
        $nomor = $_SESSION['data']['nomor'] ;
        $email = $_SESSION['data']['email'] ;
        $NIK = $_SESSION['data']['NIK'] ;
        $pass = $_SESSION['data']['password'] ;

        $query = "SELECT * FROM otp_expiry WHERE otp='" . $_POST["otp"] . "'AND email ='".$email."' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 24 HOUR)";
        $get = $connect->prepare($query);
        $get -> execute();
        $fetch = $get -> fetch(PDO::FETCH_ASSOC);
        $count  = $get->rowCount();
        
        
        if(!empty($count)) {
        	$query = "UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["otp"] . "'AND email ='".$email."'";
            $update = $connect->prepare($query);
            $update -> execute();

            $permanentDirectory = '../img/user/';

            $fileName = $_SESSION['nama_foto_KTP']; 
            $filePath = $tempDirectory . $fileName;
            $targetFilePath = $filePath; 
            $destinationFilePath = $permanentDirectory . $fileName;

            $fileName_fotoWajah = $_SESSION['nama_foto_Wajah']; 
            $filePath_fotoWajah = $tempDirectory . $fileName_fotoWajah;
            $targetFilePath_fotoWajah = $filePath_fotoWajah; 
            $destinationFilePath_fotoWajah = $permanentDirectory . $fileName_fotoWajah;

            rename($targetFilePath, $destinationFilePath);
            rename($targetFilePath_fotoWajah, $destinationFilePath_fotoWajah);

            $insert_user =$connect->prepare("insert into  users (nama,nomor,email,NIK,password,foto_KTP, foto_wajah, status) values ('$nama','$nomor','$email','$NIK','$pass','$_SESSION[nama_foto_KTP]','$_SESSION[nama_foto_Wajah]','pending')");
            $insert_user->execute();
            $_SESSION['success'] = 2;
            $_SESSION['r_status']=2;

            header("location:OTP.php");
        
        
        } else {
            $_SESSION['success'] = 0;
            $_SESSION['r_status'] = 2;
            header("location:OTP.php");
        }	

        if (file_exists($tempDirectory)) {
            // Delete all files inside the directory
            $files = glob($tempDirectory . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            // Delete the temporary directory itself
            rmdir($tempDirectory);
        }
    }

        // Add this code to check if the message container should be displayed or not
    if (!isset($_SESSION['hide_message'])) {
        $_SESSION['hide_message'] = false;
    }

    if (isset($_POST['register'])) {
        // ... (the rest of your login code)

        // Show message container when there are messages
        if (isset($message) && count($message) > 0) {
            $_SESSION['hide_message'] = false;
        }
    }
?>

<head>
<?php  require_once("../component/php/head.php");?>
<link rel="stylesheet" href="../component/style/styleRegister.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php require_once("../component/php/navbar.php");?>
    <?php if (isset($message) && count($message) > 0 && !$_SESSION['hide_message']) : ?>
        <div class="message-container">
            <?php
            foreach ($message as $message) {
                echo '
                <div id="mssg">
                    <span>' . $message . '</span>
                    <i class="fas fa-times" onclick="closeMessageContainer();"></i>
                </div>
                ';
            }
            ?>
        </div>
    <?php endif; ?>

    <!-- <div id="mssg"></div>
    
    <?php if(isset($message)){
            foreach($message as $message){
                echo' 
                <div class="alert alert-danger" role="alert">
                    <span>'.$message.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
        ';
            }
        }?>  -->

    <?php
        if ($_SESSION['r_status'] == 0) {

    ?>
    <main>
        <form action="register.php" method="post" id="registerform" enctype="multipart/form-data">
            <h2>DAFTAR</h2>

            <div class="input-box">
                <label for="NIK">NIK</label>
                <input type="text" name="NIK" id="NIK" class="box" placeholder="Masukkan NIK" required><br>
                <span class="error" id="err_NIK"></span>
            </div>

            <div class="input-box">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="box" placeholder="Masukkan Nama" required><br>
                <span class="error" id="err_nama"></span>
            </div>

            <div class="input-box">
                <label for="nomor">Nomor Telepon</label>
                <input type="text" name="nomor" id="nomor" class="box" placeholder="Masukkan Nomor Telepon" required><br>
                <span class="error" id="err_nomor"></span>
            </div>

            <div class="input-box">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="box" placeholder="Masukkan Email" required><br>
                <span class="error" id="err_email"></span>
            </div>

            <label class="input-box" for="password" style="margin-bottom: 0;">Kata Kunci</label>
            <div>
                <div class="side">
                    <div class="input-box">
                        <input type="password" name="password" id="password" class="box" style="width: 248px;" placeholder="Masukkan Kata Kunci" required class="form-control">
                    </div>

                    <div class="input-group-append">
                        <span class="input-group-text" onclick="password_show_hide1();">
                        <i class="fas fa-eye" id="show_eye1"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye1"></i>
                        </span>
                    </div>
                </div>
                <span class="error" id="err_password"></span>
            </div>

            <label class="input-box" for="password" style="margin-bottom: 0;">Konfirmasi Kata Kunci</label>
            <div>
                <div class="side">
                    <div class="input-box">
                        <input type="password" name="cpassword" id="cpassword" class="box" style="width: 248px;" placeholder="Konfirmasi Kata Kunci" required><br>
                    </div>

                    <div class="input-group-append">
                        <span class="input-group-text" onclick="password_show_hide2();">
                        <i class="fas fa-eye" id="show_eye2"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                        </span>
                    </div>
                </div>
                <span class="error" id="err_cpassword"></span>
            </div>

            <div class="input-box">
                <label for="fotoKTP">Foto KTP</label>
                <input type="file" name="fotoKTP" id="fotoKTP" class="foto" accept="image/jpg image/jpeg, image/png , image/webp" required>
                <span class="error" id="err_KTP"></span>
            </div>

            <div class="input-box">
                <label for="fotoWajah">Foto Wajah</label>
                <input type="file" name="fotoWajah" id="fotoWajah" class="foto" accept="image/jpg image/jpeg, image/png , image/webp" required>
                <span class="error" id="err_wajah"></span>
            </div>

            <div class="check">
                <input id="tnc" type="checkbox" class="check-box" name="termcondition"><span>Saya setuju dengan semua <div class="change" onclick="togglePopup()" style="display: inline; cursor:pointer;">Syarat dan Ketentuan</div></span>     
                <!-- class="click" -->
            </div>

            <input type="submit" value="Daftar" name="register" class="btn" id="registerbtn">

            <div class="group2">
                <label for="message">Sudah punya akun? <span><a class="change" href="login.php">Masuk</a></span></label>
            </div>
        </form>
    <?php 
        } 
    ?>
    </main>

    <section class="popup" id="popup-1">
        <div class="overlay"></div>

        <div class="content">
            <div class="close-btn" style="cursor: pointer;" onclick="closePopup()">x</div>

            <div class="tnc-head">
                <h3>Syarat dan Ketentuan</h3>
            </div>

            <div class="tnc-body">
                <!-- <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p> -->
                <p><strong>Persetujuan terhadap Syarat dan Ketentuan</strong></p>
                <p>Syarat dan Ketentuan ini merupakan perjanjian yang mengikat secara hukum yang dibuat antara Anda, baik secara pribadi atau atas nama suatu entitas (“Anda”) dan <strong>Voting.com</strong> (“Kami”), mengenai akses Anda terhadap penggunaan situs Voting.com serta segala bentuk media, saluran media, situs seluler, atau aplikasi seluler apa pun yang terkait, ditautkan, atau terhubung dengannya (Voting.com).</p>
                <p>Anda setuju bahwa dengan mengakses Voting.com, Anda telah membaca, memahami, dan setuju terikat dengan semua Syarat dan Ketentuan ini. Jika Anda tidak setuju dengan semua Syarat dan Ketentuan ini, maka Anda secara tegas dilarang menggunakan Voting.com dan Anda harus segera menghentikan penggunaan.</p>                
                <p>Syarat dan Ketentuan tambahan atau dokumen yang mungkin dipasang di Voting.com dari waktu ke waktu dengan ini secara tegas digabungkan di sini sebagai referensi. Kami berhak, atas kebijakan kami sendiri, untuk melakukan perubahan atau modifikasi pada Syarat dan Ketentuan ini kapan saja dan dengan alasan apapun.</p>                
                <p>Kami akan memberi tahu Anda tentang perubahan apapun dengan memperbarui tanggal “Terakhir diperbarui” dari Syarat dan Ketentuan ini, dan Anda melepaskan hak apa pun untuk menerima pemberitahuan spesifik dari setiap perubahan tersebut.</p>                
                <p>Anda bertanggung jawab untuk meninjau Syarat dan Ketentuan ini secara berkala agar tetap mengetahui pembaruan. Anda akan setuju dengan, dan akan dianggap telah mengetahui dan telah menerima, perubahan dalam Syarat dan Ketentuan yang direvisi dengan terus menggunakan Voting.com setelah tanggal Syarat dan Ketentuan yang direvisi tersebut diposting.</p>                
                <p>Informasi yang disediakan di Voting.com tidak dimaksudkan untuk didistribusikan atau digunakan oleh orang atau entitas mana pun di yurisdiksi atau negara mana pun di mana distribusi atau penggunaan tersebut akan bertentangan dengan undang-undang atau peraturan atau yang akan memaksa kami mengikuti persyaratan pendaftaran apa pun dalam yurisdiksi atau negara tersebut secara sepihak.</p>                
                <p>Oleh karena itu, orang-orang yang memilih untuk mengakses Voting.com dari lokasi lain harus melakukannya atas inisiatif mereka sendiri dan sepenuhnya bertanggung jawab untuk mematuhi undang-undang setempat, jika dan sejauh undang-undang setempat berlaku.</p>
                <p><strong>Hak Kekayaan Intelektual</strong></p>
                <p>Kecuali diindikasikan sebaliknya, Voting.com adalah properti milik "Kami" dan semua kode sumber, basis data, fungsi, perangkat lunak, desain situs, teks, foto, dan grafik di Voting.com (secara bersama-sama disebut "Konten") dan merek dagang, merek layanan, dan logo yang terkandung di dalamnya ("Merek") dimiliki atau dikendalikan oleh kami atau dilisensikan kepada kami, dan dilindungi oleh undang-undang hak cipta dan merek dagang dan berbagai hak kekayaan intelektual lainnya dan undang-undang persaingan tidak sehat Amerika Serikat, asing yurisdiksi, dan konvensi internasional.</p>
                <p>Konten dan Merek disediakan di Voting.com “SEBAGAIMANA ADANYA” hanya untuk informasi dan penggunaan pribadi Anda. Kecuali dinyatakan secara tegas dalam Syarat dan Ketentuan ini, tidak ada bagian dari Voting.com dan tidak ada Konten atau Merek yang boleh disalin, direproduksi, dikumpulkan, diterbitkan ulang, diunggah, diposting, ditampilkan untuk umum, dikodekan, diterjemahkan, ditransmisikan, didistribusikan, dijual, dilisensikan, atau dieksploitasi untuk tujuan komersial apa pun, tanpa izin tertulis sebelumnya dari kami.</p>
                <p>Selama Anda memenuhi syarat untuk menggunakan Voting.com, Anda diberikan lisensi terbatas untuk mengakses dan menggunakan Voting.com dan untuk mengunduh atau mencetak salinan dari setiap bagian Konten yang telah Anda akses dengan benar hanya untuk pribadi, penggunaan non-komersial. Kami memiliki semua hak yang tidak secara tegas diberikan kepada Anda di dalam dan ke Voting.com, Konten, dan Merek.</p>
            </div>

            <div class="tnc-foot">
                <button class="agree" onclick="agreeTermsandCondition()">Agree</button>
            </div>
        </div>
    </section>

    <script src="sweetalert.min.js"></script>
    <script>
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
            $('#password').on('input', function () {
                checkpass();
            });
            $('#cpassword').on('input', function () {
                checkcpass();
            });
            $('#fotoKTP').on('input', function () {
                checkKTP();
            });
            $('#fotoWajah').on('input', function () {
                checkwajah();
            });
            
            $('#registerbtn').click(function () {

                
                if (!checkuser() && !checkNIK() && !checkcpass() && !checknomor() && !checkemail() && !checkpass() && !checkKTP() && !checkwajah()) {
                    $("#mssg").html(`<div class="alert alert-warning">Tolong isi semua input</div>`);
                    return false;
                } else if (!checkuser() ||!checkNIK() || !checkcpass() || !checknomor() || !checkemail() || !checkpass() && !checkKTP() && !checkwajah()) {
                    $("#mssg").html(`<div class="alert alert-warning">Invalid input, tolong cek kembali!</div>`);
                    return false;
                } if(!registerform.tnc.checked) {
                alert("TERMS & CONDITIONS not checked!");
                return false;
                }
            });

        });

        function scrollToTop() {
                    window.scrollTo(0, 0);
        }

        function togglePopup() {
            scrollToTop();
            document.getElementById("popup-1").classList.add("active");
                

        }

        function closePopup() {
            document.getElementById("popup-1").classList.remove("active");
            document.getElementById("popup-1").classList.add("close");
                    
        }

        function checkuser() {
            var pattern = /^[a-zA-Z-' ]*$/;
            var user = $('#nama').val();
            var validuser = pattern.test(user);
            if (user == "") {
                $('#err_nama').html('Nama tidak boleh kosong');
                return false;
            } else if ($('#nama').val().length < 4) {
                $('#err_nama').html('Panjang karakter nama terlalu pendek');
                return false;
            } else if (!validuser) {
                $('#err_nama').html('Karakter nama hanya boleh a-z atau A-Z');
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
                $('#err_email').html('Email tidak boleh kosong');
                return false;
            } else if (!validemail) {
                $('#err_email').html('Invalid email');
                return false;
            } else {
                $('#err_email').html('');
                return true;
            }
        }

        function checkpass() {
            console.log("sass");
            var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{7,15}$/;
            var pass = $('#password').val();
            var validpass = pattern2.test(pass);

            if (pass == "") {
                $('#err_password').html('Kata kunci tidak boleh kosong');
                return false;
            } else if (!validpass) {
                $('#err_password').html('Minimal 7 sampai 15 karakter, setidaknya satu huruf besar, satu huruf kecil, satu angka dan satu karakter khusus');
                return false;

            } else {
                $('#err_password').html("");
                return true;
            }
        }

        function checkcpass() {
            console.log("cass");
            var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{7,15}$/;
            var pass = $('#password').val();
            var cpass = $('#cpassword').val();
            var validpass = pattern2.test(cpass);
            
            if (cpass == "") {
                $('#err_cpassword').html('Kata kunci konfirmasi tidak boleh kosong');
                return false;
            } else if (!validpass) {
                $('#err_cpassword').html('Minimal 7 sampai 15 karakter, setidaknya satu huruf besar, satu huruf kecil, satu angka dan satu karakter khusus');
                return false;
            } else if (pass !== cpass) {
                $('#err_cpassword').html('Kata kunci dan kata kunci konfirmasi tidak sama');
                return false;
            } else {
                $('#err_cpassword').html('');
                return true;
            }
        }

        function checknomor() {
            var pattern3 = /^08[1-9][0-9]{7,10}$/;
            var nomor = $('#nomor').val();
            var validnomor = pattern3.test(nomor);

            if (nomor == "") {
                $('#err_nomor').html('Nomor telepon tidak boleh kosong');
                return false;
            } else if (!$.isNumeric(nomor)) {
                $("#err_nomor").html("Hanya boleh angka");
                return false;
            } else if (!validnomor) {
                $("#err_nomor").html("Nomor telepon harus dimulai dengan 08xx dan terdiri dari 7-10 digit");
                return false;
            }
            else {
                $("#err_nomor").html("");
                return true;
            }
        }

        function checkNIK() {
            if ($("#NIK").val() == "") {
                $('#err_NIK').html('NIK tidak boleh kosong');
                return false;
            } else if (!$.isNumeric($("#NIK").val())) {
                $("#err_NIK").html("Hanya boleh angka");
                return false;
            } else if ($("#NIK").val().length != 13) {
                $("#err_NIK").html("Harus berisi 13 angka");
                return false;
            }
            else {
                $("#err_NIK").html("");
                return true;
            }
        }

        function checkKTP() {
            if ($("#fotoKTP").val() == "") {
                $('#err_KTP').html('Foto KTP tidak boleh kosong');
                return false;
            }
            else {
                $("#err_KTP").html("");
                return true;
            }
        }

        function checkwajah() {
            if ($("#fotoWajah").val() == "") {
                $('#err_wajah').html('Foto Wajah tidak boleh kosong');
                return false;
            }
            else {
                $("#err_wajah").html("");
                return true;
            }
        }

        function password_show_hide1() {
            console.log('ok');
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye1");
            var hide_eye = document.getElementById("hide_eye1");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function password_show_hide2() {
            console.log('ok');
            var x = document.getElementById("cpassword");
            var show_eye = document.getElementById("show_eye2");
            var hide_eye = document.getElementById("hide_eye2");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        // function password_show_hide(id) {
        //     console.log('ok');
        //     var x = document.getElementById(id);
        //     var show_eye = document.getElementById("show_eye_" + id);
        //     var hide_eye = document.getElementById("hide_eye_" + id);
        //     hide_eye.classList.remove("d-none");
        //     if (x.type === "password") {
        //         x.type = "text";
        //         show_eye.style.display = "none";
        //         hide_eye.style.display = "block";
        //     } else {
        //         x.type = "password";
        //         show_eye.style.display = "block";
        //         hide_eye.style.display = "none";
        //     }
        // }

        function agreeTermsandCondition() {
                    closePopup();

                    var checkbox = document.getElementById("tnc");
                    checkbox.checked = true;

        }

        // function togglePassword(inputId) {
        //     var passwordInput = document.getElementById(inputId);
        //     if (passwordInput.type === "password") {
        //         passwordInput.type = "text";
        //     } else {
        //         passwordInput.type = "password";
        //     }
        // }

        function closeMessageContainer() {
        // Use AJAX to inform the server to hide the message container
            $.ajax({
                type: "POST",
                url: "hide_message.php", // Replace with the actual URL of the PHP script to handle hiding the message container
                success: function() {
                    $(".message-container").hide();
                }
            });
        }
    </script>
</body>
</html>