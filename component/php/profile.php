<?php

if(isset($_POST['update_profile'])){
        
    $id = $_SESSION['user_id'];

    $nomor = $_POST['nomor'];
    

    $query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $connect->prepare($query);
    $stmt->execute([$id]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
    if (( $nomor == $existingUser['nomor'] )) {
        ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
        swal("Tidak ada perubahan data.");
        </script>   
        <?php        
        } 
        else {
            $id = (int)$id;
            $query = "SELECT * FROM `users` WHERE user_id <> ? AND nomor = ?";
            $get = $connect->prepare($query);
            $get->execute([$id, $_POST['nomor']]);

            if ($get->rowCount()>0) {
            ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
            swal("Nomor ini sudah terdaftar oleh user lain.");
            </script>   
            <?php  
            } else {
            $change = 0;
        
        if (isset($nomor)){
            $query = "UPDATE users SET nomor ='$nomor' WHERE user_id = $id";
            $updatedb= $connect->prepare($query);
            $updatedb ->execute();
            $change++;     
        }

        if ($change > 0) {
            ?>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                swal({
                    title: "Berhasil!",
                    text: "Data Anda sudah diubah",
                    icon: "success",
                    
                });
                </script>   
                <?php
            } else if ($change==0) {
                ?>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                swal("Tidak ada perubahan data.");
                </script>   
                <?php 
            header('location:user.php');
        }  

        
    }
}
            }

    }







if(isset($_POST['update_password'])) {
    $current = $_POST['current'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_id = $_SESSION['user_id'];
    
    $query = "SELECT password FROM users WHERE user_id = $user_id";
    $check_password = $connect->prepare($query);
    $check_password -> execute();
    $fetch_password = $check_password -> fetch(PDO::FETCH_ASSOC);

    if($check_password->rowCount()>0) {
        if ($current != $fetch_password['password'] ){
            ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
            swal("Kata sandi lama anda tidak tepat");
            </script>   
            <?php         
            } else {
            if ($password != $cpassword ){
                ?>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                swal("Kata sandi baru & Konfirmasi kata sandi baru tidak sesuai");
                </script>   
                <?php 
            } else {         
            if ($current == $password) {
                ?>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                swal("Kata sandi baru harus beda dengan yang lama");
                </script>   
                <?php             
                } else {
                $query = "UPDATE users SET password ='".$password."'WHERE user_id = $user_id ";
                $updatedb= $connect->prepare($query);
                $updatedb ->execute();
                ?>
                <script type="text/javascript">
                swal({
                    title: "Berhasil!",
                    text: "Anda berhasil mengubah kata sandi!",
                    icon: "success",
                    });
                </script>
                <?php
            }
             
            }
        }

    }
 
    
  }
?>