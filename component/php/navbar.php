<?php
    if(isset($_SESSION['user_name'])) {
        $user_name = $_SESSION['user_name'];
        $user_name = strtok($user_name, " ");
        $user_id = $_SESSION['user_id'];
    }

    if(isset($_GET['logout'])){
        session_destroy(); 
        ?>
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
         <script>
         swal({
             title: "Logout Successfully!",
             text: "",
             icon: "success",
             
         }).then(function() {
             window.location = "landing.php";
         });      
         </script>
         <?php
         
    } 
     
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Voting.com</title>
</head>
<body>
    <nav>
        <div class="nav-container">
            <div class="nav-left">
                <div class="logo-container">
                    <a href="#">
                        <h3>Voting</h3>
                        <p>.com</p>
                    </a>
                </div>
                <div class="nav-menu-container">
                <div class="nav-menu">
                        
                
                <?php
                    if (empty($user_id)) {
                        ?>
                        <a href="login.php" style="text-decoration: none;"><div class="nav-item">LOGIN</div></a>
                        <?php
                    } 
                    else {  
                        ?>
                        <a href="profile.php" style="text-decoration: none;"><div class="nav-item"><?= $user_name ?></div></a>
                        <?php 
                        }
                    ?>
                    </div>
                    <div class="nav-menu">
                        <a href="landing.php" style="text-decoration: none;"><div class="nav-item">HOME</div></a>
                    </div>
                    <div class="nav-menu">
                    <a href="tutorial.php" style="text-decoration: none;"><div class="nav-item">TUTORIAL</div></a>
                    </div>
                    <div class="nav-menu">
                        <a href="contact_us.php" style="text-decoration: none;"><div class="nav-item">CONTACT US</div></a>
                    </div>
                    <?php
                    if (!empty($user_id)) {
                        ?>
                        <div class="nav-item"><a href="landing.php?logout=<?=$user_id?>" style="text-decoration: none;">LOGOUT</a></div>
                        <?php
                    } 
                    else {  
                        ?>
                        <?php 
                        }
                    ?>
                                        
                </div>
            </div>
            <div class="hamburger">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>
    </nav>
    <script defer src="../component/js/nav.js"></script>