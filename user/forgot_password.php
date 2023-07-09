<?php
    include "../component/php/connect.php";
    include '../component/php/sendemail.php';

    $mailSent = false;

    if(isset($_POST['kirim']) || isset($_POST['resend'])){

        $email = $_POST['email'];
        $select_user =$connect->prepare("SELECT user_id FROM users WHERE email = ?");
        $select_user->execute([$email]);

        if($select_user->rowCount()>0){
            $mailSent = true;
            $otp = rand(100000,999999);
            sendOTP($_POST['email'], $otp);
            $query = "INSERT INTO otp_expiry(otp,is_expired,create_at,email) VALUES ('" . $otp . "', 0, '" . date("Y-m-d H:i:s"). "', '" . $email . "')";
            $insert_otp = $connect -> prepare($query);
            $insert_otp -> execute();      
        } else {
            $message[] = "Email anda belum diregistrasi";
        }
       
    }

    if(isset($_POST['verify'])){
        if (isset($_POST['email']) && isset($_POST['verificationCode']) && $_POST['verificationCode'] != '') {
            $verificationCode = $_POST['verificationCode'];
            $email = $_POST['email'];

            $query = "SELECT * FROM otp_expiry WHERE otp='" . $_POST["verificationCode"] . "'AND email ='".$email."' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 24 HOUR)";
            $get = $connect->prepare($query);
            $get -> execute();
            $fetch = $get -> fetch(PDO::FETCH_ASSOC);
            $count  = $get->rowCount();


            if(!empty($count)) {
                $query = "UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["verificationCode"] . "'AND email ='".$email."'";
                $update = $connect->prepare($query);
                $update -> execute();

                $query = "SELECT * FROM users WHERE email= '$email'";
                $result = $connect -> prepare($query);
                $result -> execute();

                if($result -> rowCount() > 0) {
                    $fetch = $result -> fetch(PDO::FETCH_ASSOC);
                    $uid = $fetch['user_id'];
                    $_SESSION['forgotpass']="yes";
                    header("location:change_password.php?uid=$uid");
                } 
            } else {
                ?>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                swal("Kode Verifikasi Anda Salah");    
                </script>   
                <?php
            } 

            
        }
    }

    // Add this code to check if the message container should be displayed or not
    if (!isset($_SESSION['hide_message'])) {
        $_SESSION['hide_message'] = false;
    }

    if (isset($_POST['kirim'])) {
        // ... (the rest of your login code)

        // Show message container when there are messages
        if (isset($message) && count($message) > 0) {
            $_SESSION['hide_message'] = false;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php   require_once("../component/php/head.php"); ?>
    <link rel="stylesheet" href="../component/style/styleForgotPassword.css">
    <title></title>

</head>

<body>
    <?php   require_once("../component/php/navbar.php"); ?>

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
            <h2>LUPA KATA KUNCI</h2>

            <div class="input-box">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value='<?php if (isset($_POST['email'])) echo $_POST['email'];?>' class="box" placeholder="Masukkan Email" required><br>
                <span class="error" id="err_email"></span>
            </div>

            <div class="input-box" style='<?php if ($mailSent) echo "display:block"; else echo "display:none;" ?>'>
                <label for="verificationCode">Kode Verifikasi</label>
                <input type="text" name="verificationCode" id="verificationCode" class="box" placeholder="Masukkan Verification Code"><br>
            </div>

            <div class="side">
                <input type="submit" style='margin-left: 20px; display:<?php if($mailSent) echo 'none'; else echo 'block'; ?>'value="Kirim" name="kirim" class="btn" id="kirimbtn">
                <input type="submit" style='margin-left: 20px; display:<?php if($mailSent) echo 'block'; else echo 'none'; ?>' value="Kirim Ulang" name="resend" class="btn" id="btnResend" onclick="">
                <input type="submit" style='margin-left: 20px; display:<?php if($mailSent) echo 'block'; else echo 'none'; ?>' value="Verifikasi" name="verify" class="btn" id="btnVerify" onclick="">
            </div>
        </form>
    </main>

    <script>
        $(document).ready(function () {
            $('#email').on('input', function () {
                checkemail();
            });
            
            $('#kirimbtn').click(function () {

                
                if (!checkemail()) {
                    $("#mssg").html(`<div class="alert alert-warning">Tolong isi semua input</div>`);
                    return false;
                } else if (!checkemail()) {
                    $("#mssg").html(`<div class="alert alert-warning">Invalid input, tolong cek kembali!</div>`);
                    return false;
                }
            });

        });

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