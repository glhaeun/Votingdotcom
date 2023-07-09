<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php require_once("../component/php/head.php"); ?>
    <style>
        body {
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .section {
            min-height: calc(100vh - 120px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            box-sizing: border-box;
           
        }

        .container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 4px 4px 4px rgba(187, 12, 12, 0.5);
        }

        .container h2 {
            color: #bb0c0c;;
            margin-top: 0;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
        }

        .submit-button {
            text-align: center;
        }

        .submit-button input[type="submit"] {
            padding: 12px 24px;
            background-color: #333333;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }


    </style>
</head>
<body>
    <?php require("../component/php/navbar.php"); ?>

    <div class="section">
        <div class="container">
            <h2>Contact Us</h2>
            <?php
                if(isset($_POST['submit'])) {
                    if(sendMsg($_POST['email'], $_POST['name'], $_POST['message'])) {
                        ?>
                        <script>
                        Swal.fire(
                            "Email Terkirim!",
                            "Terima kasih telah mengirimkan masukan kepada kami!",
                            "success"
                        )
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                        Swal.fire(
                            "Gagal Mengirim!",
                            "Terjadi kesalahan",
                            "error"
                        )
                        </script>
                        <?php
                    }
                }
            ?>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Enter your message" rows="6" required></textarea>
                </div>
                <div class="submit-button">
                    <input type="submit" name='submit' value="Send Message">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../phpmailer/vendor/autoload.php';
    function sendMsg($email, $name, $message) {
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
        $mail->SetFrom($email, $name);
        $mail->Subject = "Kritik dan saran dari " . $name;
        $mail->AddAddress("{$email}","noreply");
        $mail->MsgHTML($message);
        $mail->IsHTML(true);	

        if($mail->Send()) {
            return true;
        }
           
        return false;
            
    }
?>