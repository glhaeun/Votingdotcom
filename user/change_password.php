<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting.com</title>
    <?php include "../component/php/head.php";?>
    <link rel="stylesheet" href="../component/style/login.css">
    
</head>
<?php include "../component/php/connect.php";?>

<body>

<?php
    include "../component/php/sendemail.php";

    if(isset($_POST['login'])){

        $NIK = $_POST['NIK'];
        $password = $_POST['password'];

        $select_user =$connect->prepare("SELECT user_id, nama, status FROM users WHERE NIK = ? AND password = ?");
        $select_user->execute([$NIK,$password]);
        $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

        if($select_user->rowCount()>0) {
            if($fetch_user['status'] == 'pending') {
                $message[] = "Akun anda belum diverifikasi oleh admin!";
            }
            else {
            $query = "SELECT nama, email, user_id FROM users WHERE NIK = ? AND password = ?";
            $select_user_data = $connect -> prepare($query);
            $select_user_data -> execute([$NIK,$password]);
    
            $fetch_user_data= $select_user_data->fetch(PDO::FETCH_ASSOC);
            $_SESSION['email'] = $email = $fetch_user_data['email'];

            $otp = rand(100000,999999);
            sendOTP($email,$otp);
            $query = "INSERT INTO otp_expiry(otp,is_expired,create_at,email) VALUES ('" . $otp . "', 0, '" . date("Y-m-d H:i:s"). "', '" . $email . "')";
            $insert_otp = $connect -> prepare($query);
            $insert_otp -> execute();      
            $_SESSION['l_status']=1;
            $_SESSION['from']='login';
            header("location:OTP.php");
            
            //header('location:landing_ziven.php');
            }
        }
            else{
                ?>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                swal({
                    title: "Gagal!",
                    text: "NIK/Kata Kunci Anda salah",
                    icon: "error",
                    
                });      
                </script>   
                <?php
        }
    }

    
    if(isset($_POST['submit_otp'])) {


        $query = "SELECT * FROM otp_expiry WHERE otp='" . $_POST["otp"] . "'AND email ='".$_SESSION['email'] ."' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 24 HOUR)";
        $get = $connect->prepare($query);
        $get -> execute();
        $fetch = $get -> fetch(PDO::FETCH_ASSOC);
        $count  = $get->rowCount();
        
        
        if(!empty($count)) {
            $query = "UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["otp"] . "'AND email ='".$email."'";
            $update = $connect->prepare($query);
            $update -> execute();

            $_SESSION['l_success'] = 2;
            $_SESSION['l_status']=2;

            $select_user =$connect->prepare("SELECT user_id, nama FROM users WHERE email = '".$_SESSION['email'] ."'");
            $select_user->execute();
            $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

            $_SESSION['user_id'] = $fetch_user['user_id'] ;
            $_SESSION['user_name'] =$fetch_user['nama'] ;
            header("location:OTP.php");
        } 
        else {
            $_SESSION['l_success'] = 0;
            $_SESSION['l_status'] = 2;
            header("location:OTP.php");
        }	
    }

    // Add this code to check if the message container should be displayed or not
    if (!isset($_SESSION['hide_message'])) {
        $_SESSION['hide_message'] = false;
    }

    if (isset($_POST['login'])) {
        // ... (the rest of your login code)

        // Show message container when there are messages
        if (isset($message) && count($message) > 0) {
            $_SESSION['hide_message'] = false;
        }
    }
?>
<?php require_once("../component/php/navbar.php");?>


        
<main>
        <form action="login.php" method="post">
            <h2>MASUK</h2>

            <div class="input-box">
                <label for="NIK">NIK</label>
                <input type="text" name="NIK" id="NIK" class="box" placeholder="Masukkan NIK" required><br>
                <span class="error" id="err_NIK"></span>
            </div>

            <label class="input-box" for="password" style="margin-bottom: 0;">Kata Kunci</label>
            <div>
                <div class="side">
                    <div class="input-box">
                        <input type="password" name="password" id="password" class="box" style="width: 248px;" placeholder="Masukkan Kata Kunci" required class="form-control">
                    </div>

                    <div class="input-group-append">
                        <span class="input-group-text" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                        </span>
                    </div>
                </div>
                <span class="error" id="err_password"></span>
            </div>

            <div class="group1">
                <a class="change" id="forget" href="forgot_password.php">Lupa Kata Kunci?</a>
            </div>

            <input type="submit" value="Masuk" name="login" class="btn" id="loginbtn">

            <div class="group2">
                <label for="message">Belum terdaftar? <span><a class="change" href="register.php">Daftar sekarang!</a></span></label>
            </div>
        </form>
    </main>

    <script>
        $(document).ready(function () {
            $('#NIK').on('input', function () {
                checkNIK();
            });
            $('#password').on('input', function () {
                checkpass();
            });
            
            $('#loginbtn').click(function () {              
                if (!checkNIK() && !checkpass()) {
                    $("#mssg").html(`<div class="alert alert-warning">Tolong isi semua input</div>`);
                    return false;
                } else if (!checkNIK() || !checkpass()) {
                    $("#mssg").html(`<div class="alert alert-warning">Invalid input, tolong cek kembali!</div>`);
                    return false;
                } 
            });
        });

        function checkNIK() {
            if ($("#NIK").val() == "") {
                $("#err_NIK").html('NIK tidak boleh kosong');
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

        function checkpass() {
            console.log("sass");
            var pattern = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{7,15}$/;
            var pass = $('#password').val();
            var validpass = pattern.test(pass);

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

        function password_show_hide() {
            console.log('ok');
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
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

        // function togglePassword() {
        //     var passwordInput = document.getElementById("password");
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

