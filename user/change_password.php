<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../component/php/head.php";?>
    <link rel="stylesheet" href="../component/style/styleChangePassword.css">
    
</head>
<?php include "../component/php/connect.php";?>

<body>
    
<?php

if(!isset($_SESSION['forgotpass'])){
    header( "location:forgot_password.php" );
}

if(isset($_GET['uid'])){
    $changeuid = $_GET['uid'];
} 

if (isset($_POST['change'])){

$query = "SELECT password FROM users WHERE user_id = :user_id";
$stmt = $connect->prepare($query);
$stmt->bindParam(':user_id', $changeuid); // Replace with the actual user ID
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$old_password = $row['password'];

$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

$password_pattern = '/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/';
$is_valid_password = preg_match($password_pattern, $password);

if($is_valid_password ){
    if($password === $cpassword){
        if($password !== $old_password){
            $update_query = "UPDATE users SET password = :password WHERE user_id = :user_id";
            $update_stmt = $connect->prepare($update_query);
            $update_stmt->bindParam(':password', $password);
            $update_stmt->bindParam(':user_id', $changeuid); // Replace with the actual user ID
            $update_stmt->execute();
    ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    swal({
        title: "Berhasil!",
        text: "Berhasil mengubah kata sandi",
        icon: "success",
        
    }).then(function() {
        window.location = "login.php";
    });      
    </script>
    <?php
} else {
    ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    swal({
        title: "Invalid!",
        text: "Password baru tidak boleh sama dengan password sebelumnya!",
        icon: "error",
        
    }).then(function() {
        window.location = "login.php";
    });      
    </script>
    <?php
        }
    } else {
        ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    swal({
        title: "Invalid!",
        text: "Passwords dan konfirmasi password tidak sesuai!",
        icon: "error",
        
    }).then(function() {
        window.location = "login.php";
    });      
    </script>
    <?php
    }
} else {
    ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    swal({
        title: "Invalid!",
        text: "Kata sandi harus sepanjang 7-15, setidaknya satu digit, setidaknya satu karakter khusus !",
        icon: "error",
        
    }).then(function() {
        window.location = "login.php";
    });      
    </script>
    <?php
}
}


?>
    <?php include("../component/php/navbar.php");?>
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

<!-- <?php if(isset($message)){
            foreach($message as $message){
                echo' 
                <div class="alert alert-danger" role="alert">
                    <span>'.$message.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
        ';
            }
        }?>  -->
    <main>
        <form action="" method="post">
            <h2>UBAH KATA KUNCI</h2>
            <!-- <?php
?> -->

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

            <input type="submit" value="Ubah" name="change" class="btn" id="changebtn">
        </form>
    </main>

    <script>
        $(document).ready(function () {
            $('#password').on('input', function () {
                checkpass();
            });
            $('#cpassword').on('input', function () {
                checkcpass();
            });
            
            $('#changerbtn').click(function () {

                
                if (!checkpass() && !checkcpass()) {
                    $("#mssg").html(`<div class="alert alert-warning">Tolong isi semua input</div>`);
                    return false;
                } else if (!checkpass() || !checkcpass()) {
                    $("#mssg").html(`<div class="alert alert-warning">Invalid input, tolong cek kembali!</div>`);
                    return false;
                }
            });

        });

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
                $('#err_cpassword').html('Konfirmasi kata kunci tidak boleh kosong');
                return false;
            } else if (!validpass) {
                $('#err_cpassword').html('Minimal 7 sampai 15 karakter, setidaknya satu huruf besar, satu huruf kecil, satu angka dan satu karakter khusus');
                return false;
            } else if (pass !== cpass) {
                $('#err_cpassword').html('Kata kunci dan konfirmasi kata kunci tidak sama');
                return false;
            } else {
                $('#err_cpassword').html('');
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