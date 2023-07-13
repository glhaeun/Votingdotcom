<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../phpmailer/vendor/autoload.php';
    function sendEmail($email) {
    
    
        require('../phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php');
        require('../phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php');
        require('../phpmailer/vendor/phpmailer/phpmailer/src/Exception.php');

        $message_body = "Akun anda telah diverifikasi!";
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'tls'; // tls or ssl
            $mail->Port     = "2525";
            $mail->Username = 'smtp_username';   //email
            $mail->Password = 'smtp_password' ; 
            $mail->Host     = "mail.smtp2go.com";
            $mail->Mailer   = "smtp";
            $mail->AddReplyTo('evotingindonesia23@gmail.com','Voting.com');
            $mail->SetFrom('evotingindonesia23@gmail.com','Voting.com');
            $mail->AddAddress($email);
            $mail->Subject = "Update dari evoting!";
            $mail->MsgHTML($message_body);
            $mail->IsHTML(true);		
            $result = $mail->Send();
    
            if(!$result) 
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } 
        
    }

    function sendEmail_rejection($email) {
    
    
        require('../phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php');
        require('../phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php');
        require('../phpmailer/vendor/phpmailer/phpmailer/src/Exception.php');

        $message_body = "Akun anda gagal diverifikasi! Silakan registrasi ulang!";
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'tls'; // tls or ssl
            $mail->Port     = "2525";
            $mail->Username = 'smtp_username';   //email
            $mail->Password = 'smtp_password' ; 
            $mail->Host     = "mail.smtp2go.com";
            $mail->Mailer   = "smtp";
            $mail->AddReplyTo('evotingindonesia23@gmail.com','Voting.com');
            $mail->SetFrom('evotingindonesia23@gmail.com','Voting.com');
            $mail->AddAddress($email);
            $mail->Subject = "Update dari evoting!";
            $mail->MsgHTML($message_body);
            $mail->IsHTML(true);		
            $result = $mail->Send();
    
            if(!$result) 
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } 
        
    }

    function sendEmailChangeName($email, $status) {
    
    
        require('../phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php');
        require('../phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php');
        require('../phpmailer/vendor/phpmailer/phpmailer/src/Exception.php');

            $message_body = "Nama anda ".$status." berubah!";
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'tls'; // tls or ssl
            $mail->Port     = "2525";
            $mail->Username = 'smtp_username';   //email
            $mail->Password = 'smtp_password' ; 
            $mail->Host     = "mail.smtp2go.com";
            $mail->Mailer   = "smtp";
            $mail->AddReplyTo('evotingindonesia23@gmail.com','Voting.com');
            $mail->SetFrom('evotingindonesia23@gmail.com','Voting.com');
            $mail->AddAddress($email);
            $mail->Subject = "Update dari evoting!";
            $mail->MsgHTML($message_body);
            $mail->IsHTML(true);		
            $result = $mail->Send();
    
            if(!$result) 
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } 
        
    }
    
?>