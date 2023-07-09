

<script src="../vendor/sweetalert/sweetalert.min.js"></script>
<?php 
    if(isset($_GET['logout'])){        
        header('location:login.php');
        $_SESSION = array();
        session_destroy();
    } 
?>  