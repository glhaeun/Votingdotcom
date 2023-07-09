<?php
  
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

// require 'D:\xampp\phpmailer\vendor\autoload.php';
    require '../phpmailer/vendor/autoload.php';
    function sendOTP($email, $otp) {
        require('../phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php');
        require('../phpmailer/vendor/phpmailer/phpmailer/src/Exception.php');    
        require('../phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPDebug = 0;
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Timeout = 60;
        $mail->SMTPKeepAlive = true; 
        $mail->Username = "evotingindonesia23@gmail.com";
        $mail->Password = "ldaxltxowanuluyu";
        $mail->SetFrom("evotingindonesia23@gmail.com","E-Voting Indonesia");
        $mail->Subject = "Verification Code";
        $mail->AddAddress("{$email}","noreply");
        $mail->MsgHTML("OTP untuk Voting.com adalah {$otp}");
        $mail->IsHTML(true);	
        $result = $mail->Send();

            if($mail->Send()) {
                $message[] = "Kode verifikasi telah dikirim";
                $mailSent = true;
            }
            else {
                $message[] = "Gagal mengirimkan kode verifikasi";
                $mailSent = false;
            }
    }


?>