<!-- candidate -->
<!-- delete -->
<?php

use PHPMailer\PHPMailer\POP3;

     if(isset($_GET['delete_candidate'])){
        $delete_id = $_GET['delete_candidate'];
        $query = "SELECT * from candidate WHERE id = ?";
        $get_candidate = $connect->prepare($query);
        $get_candidate -> execute([$delete_id]);
        $del_candidate = $get_candidate-> fetch(PDO::FETCH_ASSOC);
        $cat_name = $del_candidate['voting_name'];
        $candidate_name = $del_candidate['nama_calon'];

        if ($del_candidate['voting_name'] == '') {
        $query="DELETE FROM candidate WHERE id = ?";
        $delete_candidate = $connect->prepare($query);
        $delete_candidate -> execute([$delete_id]);

        flash_alert('Message', 'Kandidat berhasil dihapus!', FLASH_SUCCESS);

        // Redirect to the same page or any desired page
        header("Location: candidate.php");
        exit();
        } else {
            $query="SELECT * FROM category WHERE nama = '$cat_name'";
            $get_category = $connect->prepare($query);
            $get_category -> execute();
            $fetch_category=$get_category->fetch(PDO::FETCH_ASSOC);

            $cat_id = $fetch_category['category_id'];
            $jumlah_calon = $fetch_category['jml_calon'];

            if($jumlah_calon == 1){
                $query = "UPDATE category SET jml_calon = 0, status ='Inactive' WHERE category_id = $cat_id";
                $update_category = $connect->prepare($query);
                $update_category -> execute();
            } else {
                $jumlah_calon = (int)$jumlah_calon-1;
                $query = "UPDATE category SET jml_calon = $jumlah_calon WHERE category_id = $cat_id";
                $update_category = $connect->prepare($query);
                $update_category -> execute();
            }
        
            $query="DELETE FROM votes WHERE choose = ?";
            $delete_votes = $connect->prepare($query);
            $delete_votes -> execute([$candidate_name]);
                
            $query="DELETE FROM candidate WHERE id = ?";
            $delete_candidate = $connect->prepare($query);
            $delete_candidate -> execute([$delete_id]);
    
        flash_alert('Message', 'Kandidat berhasil dihapus!', FLASH_SUCCESS);

        // Redirect to the same page or any desired page
        header("Location: candidate.php");
        exit();
            
        }
    
    }
?>

<!-- add -->
<?php
    if(isset($_POST['submit'])){
        $namacalon = $_POST['namacalon'];
        $namawakil = $_POST['namawakil'];
        $visi = str_replace("\n", "<br>", $_POST['visi']);
        $misi = str_replace("\n", "<br>", $_POST['misi']);
        $votingtipe = $_POST['votingtipe'];
        $parpol = $_POST['parpol'];

        
        
    $fotocalon = $_FILES['fotocalon']['name'];
    $fotocalon_size= $_FILES['fotocalon']['size'];
    $fotocalon_tmpname= $_FILES['fotocalon']['tmp_name'];
    $fotocalon_folder= '../img/candidate/'.$fotocalon; 
    
    $fotowakil = $_FILES['fotowakil']['name'];
    $fotowakil_size= $_FILES['fotowakil']['size'];
    $fotowakil_tmpname= $_FILES['fotowakil']['tmp_name'];
    $fotowakil_folder= '../img/candidate/'.$fotowakil; 

    $select_calon = $connect->prepare("SELECT * FROM candidate WHERE LOWER(nama_calon) = LOWER(?) ");
    $select_calon -> execute([$namacalon]);

    $select_wakil = $connect->prepare("SELECT * FROM candidate WHERE LOWER(nama_wakil) = LOWER(?) ");
    $select_wakil -> execute([$namawakil]);

    if($select_calon->rowCount() > 0  || $select_wakil->rowCount() > 0) {
        flash_alert('Message', 'Calon/Wakil sudah terdaftar!',FLASH_DANGER);
    } 
    else {
        if($fotocalon_size > 2000000 || $fotowakil_size > 2000000 ) {
            flash_alert('Message', 'Ukuran foto terlalu besar',FLASH_DANGER);
        } 
        else {

        move_uploaded_file($fotowakil_tmpname, $fotowakil_folder);
        move_uploaded_file($fotocalon_tmpname, $fotocalon_folder);
        $query = "INSERT INTO candidate (foto_calon, nama_calon, voting_name,foto_wakil,nama_wakil,visi, misi,partai) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_product = $connect->prepare($query);
        $insert_product -> execute([$fotocalon, $namacalon, $votingtipe, $fotowakil, $namawakil, $visi, $misi, $parpol]);
            
        if($votingtipe!=''){
            $select_category = $connect->prepare("SELECT * FROM category WHERE nama = ? ");
            $select_category -> execute([$votingtipe]);
            $check = $select_category->fetch(PDO::FETCH_ASSOC);
    
                $jml_calon = $check['jml_calon'];
    
                $jml_calon = $jml_calon+1;
                $query = "UPDATE category SET jml_calon ='".$jml_calon."', status ='Active' WHERE nama = '$votingtipe'";
                $updatedb= $connect->prepare($query);
                $updatedb ->execute();
    
        }

    }
    flash_alert('Message', 'Berhasil mendaftarkan kandidat!',FLASH_SUCCESS);
    header('refresh:2;url=candidate.php');
    }
    }
?>
<!-- update -->


<?php

if(isset($_POST['submit_candidate'])){


    $namacalon = $_POST['namacalon'];
    $namawakil = $_POST['namawakil'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $votingtipe = $_POST['votingtipe'];
    $parpol = $_POST['parpol'];
    

    $changes=0;

    $update = $_GET['update_candidate'];

    
    $fotocalon = $_FILES['fotocalon']['name'];
    $fotocalon_size= $_FILES['fotocalon']['size'];
    $fotocalon_tmpname= $_FILES['fotocalon']['tmp_name'];
    $fotocalon_folder= '../img/candidate/'.$fotocalon; 
    
    $fotowakil = $_FILES['fotowakil']['name'];
    $fotowakil_size= $_FILES['fotowakil']['size'];
    $fotowakil_tmpname= $_FILES['fotowakil']['tmp_name'];
    $fotowakil_folder= '../img/candidate/'.$fotowakil; 

$select_calon = $connect->prepare("SELECT * FROM candidate WHERE lower(nama_calon) = lower(?) AND id <> $update; ");
$select_calon -> execute([$namacalon]);
        
$select_wakil = $connect->prepare("SELECT * FROM candidate WHERE lower(nama_wakil) = lower(?) AND id <> $update");
$select_wakil -> execute([$namawakil]);

if(($fotocalon_size) > 30000000 || ($fotowakil_size) > 30000000 ) {

    flash_alert('Message','Ukuran foto terlalu besar!',FLASH_DANGER);
  
} else if($select_calon->rowCount() > 0 || $select_wakil->rowCount() > 0 ) {
    flash_alert('Message','Calon/Wakil sudah terdaftar!',FLASH_DANGER);

} else {

    if(!empty($fotocalon)) {
        $query = "UPDATE candidate SET foto_calon =? WHERE id = $update";
        $update_fotocalon = $connect -> prepare($query);
        $update_fotocalon -> execute ([$fotocalon]);
        move_uploaded_file($fotocalon_tmpname, $fotocalon);
}

if(!empty($fotowakil)) {

    $query = "UPDATE candidate SET foto_wakil =? WHERE id = $update";
    $update_fotowakil = $connect -> prepare($query);
    $update_fotowakil -> execute ([$fotowakil]);
    move_uploaded_file($fotowakil_tmpname, $fotowakil);
}

if (!empty($namacalon)){

    $query = "UPDATE candidate SET nama_calon ='".$namacalon."' WHERE id = $update";
    $updatedb= $connect->prepare($query);
    $updatedb ->execute();
    }

    if (!empty($namawakil)){
        $query = "UPDATE candidate SET nama_wakil ='".$namawakil."' WHERE id = $update";
        $updatedb= $connect->prepare($query);
        $updatedb ->execute();
}

if (!empty($visi)){
    $visi = str_replace("\n", "<br>", $visi);
    $query = "UPDATE candidate SET visi ='".$visi."' WHERE id = $update";
    $updatedb= $connect->prepare($query);
    $updatedb ->execute();

}

if (!empty($misi)){
    $misi = str_replace("\n", "<br>", $misi);
    $query = "UPDATE candidate SET misi ='".$misi."' WHERE id = $update";
    $updatedb= $connect->prepare($query);
    $updatedb ->execute();

}

if (!empty($votingtipe)){

    if ($votingtipe != 'tidakikut'){
    $query = "SELECT * FROM candidate WHERE id = $update";
    $check = $connect -> prepare($query);
    $check ->execute();
    $fetch = $check->fetch(PDO::FETCH_ASSOC);
    if($fetch['voting_name'] != ''){
        $category_name = $fetch['voting_name'];
        $query = "SELECT * FROM category WHERE nama = '$category_name'";
        $check = $connect -> prepare($query);
        $check ->execute();
        $get = $check->fetch(PDO::FETCH_ASSOC);
        $jumlah_calon = $get['jml_calon'];
        $detail = $get['category_id'];


        if ($jumlah_calon == 1) {
            $query = "UPDATE category SET jml_calon = 0, status ='Inactive' WHERE category_id = $detail";
            $update_category = $connect->prepare($query);
            $update_category -> execute();
        } else {
            $jumlah_calon = $jumlah_calon -1;
            $query = "UPDATE category SET jml_calon = $jumlah_calon WHERE category_id = $detail";
            $update_category = $connect->prepare($query);
            $update_category -> execute();
        }

    }



    $query = "SELECT * FROM candidate WHERE voting_name = '$votingtipe' AND id = $update";
    $check = $connect -> prepare($query);
    $check -> execute();

    if ($check -> rowCount() < 1) {
    $query = "UPDATE candidate SET voting_name ='".$votingtipe."' WHERE id = $update";
    $updatedb= $connect->prepare($query);
    $updatedb ->execute();

    $query = "SELECT jml_calon FROM category WHERE nama = '$votingtipe'";
    $get_jmlcalon = $connect -> prepare($query);
    $get_jmlcalon -> execute();

    $fetchjml = $get_jmlcalon->fetch(PDO::FETCH_ASSOC);

    $jumlah_calon = $fetchjml['jml_calon'];
    $jumlah_calon = $jumlah_calon +1;

    $query = "UPDATE category SET jml_calon ='".$jumlah_calon."', status ='Active' WHERE nama = '$votingtipe'";
    $updatedb= $connect->prepare($query);
    $updatedb ->execute();

} } else {
    $query = "SELECT * FROM candidate WHERE id = $update";
    $check = $connect -> prepare($query);
    $check ->execute();
    $fetch = $check->fetch(PDO::FETCH_ASSOC);
    $name = $fetch['nama_calon'];
    if($fetch['voting_name'] != ''){
        $category_name = $fetch['voting_name'];
        $query = "SELECT * FROM category WHERE nama = '$category_name'";
        $check = $connect -> prepare($query);
        $check ->execute();
        $get = $check->fetch(PDO::FETCH_ASSOC);
        $jumlah_calon = $get['jml_calon'];
        $detail = $get['category_id'];


        if ($jumlah_calon == 1) {
            $query = "UPDATE category SET jml_calon = 0, status ='Inactive' WHERE category_id = $detail";
            $update_category = $connect->prepare($query);
            $update_category -> execute();
        } else {  
            
            $jumlah_calon = $jumlah_calon -1;
            
            $query = "UPDATE category SET jml_calon = $jumlah_calon WHERE category_id = $detail";
            $update_category = $connect->prepare($query);
            $update_category -> execute();
        }

        $query = "DELETE FROM votes WHERE category_name = '$category_name' AND choose = '$name'";
        $delete_votes = $connect->prepare($query);
        $delete_votes -> execute();
    }

    $query = "SELECT * FROM candidate WHERE voting_name = '' AND id = $update";
    $check = $connect -> prepare($query);
    $check -> execute();

    if ($check -> rowCount() < 1) {
    $query = "UPDATE candidate SET voting_name ='' WHERE id = $update";
    $updatedb= $connect->prepare($query);
    $updatedb ->execute();
    } } }

    if (!empty($parpol)){
        $query = "UPDATE candidate SET partai ='".$parpol."' WHERE id = $update";
        $updatedb= $connect->prepare($query);
        $updatedb ->execute();
    }

    flash_alert('Message','Berhasil mengubah data kandidat!',FLASH_SUCCESS);

    header('refresh:2;url=candidate.php');
}

}   

if(isset($_POST['cancel_candidate'])){
    header('location:candidate.php');
}
?>





<!-- category -->
<!-- delete -->

<?php
        if(isset($_GET['delete_category'])){
            $delete_id = $_GET['delete_category'];
        
            $query="SELECT nama FROM category WHERE category_id = ?";
            $get_category = $connect->prepare($query);
            $get_category -> execute([$delete_id]);
            $del_category = $get_category-> fetch(PDO::FETCH_ASSOC);
            $cat = $del_category['nama'];
    
            $query="SELECT * FROM candidate WHERE voting_name = ?";
            $get_category = $connect->prepare($query);
            $get_category -> execute([$cat]);
            
            if($get_category->rowCount()>0){
                $query = "UPDATE candidate SET voting_name = '' WHERE voting_name = '$cat'";
                $update_candidate = $connect->prepare($query);
                $update_candidate -> execute();   
            }
        
            $query="SELECT * FROM votes WHERE category_name = ?";
            $get_category = $connect->prepare($query);
            $get_category -> execute([$cat]); 

            if($get_category->rowCount()>0){
            $query="DELETE FROM votes WHERE category_name = '$cat";
            $del_votes = $connect->prepare($query);
            $del_votes -> execute([]);
            }

            $query="DELETE FROM category WHERE category_id = ?";
            $del_category = $connect->prepare($query);
            $del_category -> execute([$delete_id]);
    
            flash_alert('Message','Berhasil menghapus kategori!',FLASH_SUCCESS);
            header('refresh:2;url=category.php');
            
        }
?>
<!-- add -->
<?php
if(isset($_POST['submit_category'])) {
    $votetitle = $_POST['votetitle'];
    $status = $_POST['status'];
    $start = $_POST['start_tggl'];
    $end = $_POST['end_tggl'];
    $detail = $_POST['detail'];
    $candidate = $_POST['candidate'];
    $jabatan = $_POST['jabatan'];

    $select_category = $connect->prepare("SELECT * FROM category WHERE nama = ?");
    $select_category->execute([$votetitle]);

    if ($select_category->rowCount() > 0) {
        flash_alert('Message', 'Kategori sudah terdaftar!', FLASH_DANGER);
    } else {
        if(strtotime($start) > strtotime($end)){
            flash_alert('Message','Jadwal tidak tepat! (Tanggal mulai tidak boleh lebih dari Tanggal Berakhir)', FLASH_DANGER);
            }
        else {
            $uniqueCandidates = []; // Array to store unique candidate names
            $counter = 0;

            foreach ($candidate as $candidates) {
                // Check if the candidate name is unique
                if (!in_array($candidates, $uniqueCandidates)) {
                    // Update the candidate with voting name and jabatan
                    $query = "UPDATE candidate SET voting_name = ?, nama_jabatan = ? WHERE nama_calon = ?";
                    $update_candidate = $connect->prepare($query);
                    $update_candidate->execute([$votetitle, $jabatan, $candidates]);

                    // Increment the counter only for unique candidates
                    $counter++;

                    // Add the candidate name to the uniqueCandidates array
                    $uniqueCandidates[] = $candidates;
                }
            }

            $query = "INSERT INTO category (`nama`, `details`, `start_tggl`, `end_tggl`, `jml_calon`, `status`, `nama_jabatan`) VALUES (?,?,?,?,?,?,?)";
            $insert_category = $connect->prepare($query);
            $insert_category->execute([$votetitle, $detail, $start, $end, $counter, $status, $jabatan]);

            flash_alert('Message', 'Berhasil menambah kategori!', FLASH_SUCCESS);
            header('refresh:2;url=category.php');
            
            
        }
    }
    }


?>

<!-- update -->

<?php
    if(isset($_POST['cancel_category'])){
        header('location:category.php');
    }

    if (isset($_POST['update_category'])) {
        $votetitle = $_POST['votetitle'];
        $status = $_POST['status'];
        $start = $_POST['start_tggl'];
        $end = $_POST['end_tggl'];
        $detail = $_POST['detail'];
        $namajabatan = $_POST['nama_jabatan'];
        $update = $_GET['update_category'];
    
        // Validate and sanitize the input values if needed

        $select_category = $connect->prepare("SELECT * FROM category WHERE category_id = ?");
        $select_category->execute([$update]);
        $fetch_category = $select_category->fetch(PDO::FETCH_ASSOC);
    
        $select_category = $connect->prepare("SELECT * FROM category WHERE nama = ? AND category_id <> ?");
        $select_category->execute([$votetitle, $update]);
    
        if ($select_category->rowCount() > 0) {
            flash_alert('Message','Kategori sudah terdaftar!',FLASH_DANGER) ;
        } else {
            if(strtotime($start) > strtotime($end)){
                flash_alert('Message','Jadwal tidak tepat! (Tanggal mulai tidak boleh lebih dari Tanggal Berakhir)', FLASH_DANGER);
            } else {
                // Use prepared statements for all SQL queries to prevent SQL injection
    
                if (isset($votetitle)) {
                    // Update candidate voting_name
                    $query = "UPDATE candidate SET voting_name = ? WHERE voting_name = ?";
                    $update_candidate = $connect->prepare($query);
                    $update_candidate->execute([$votetitle, $fetch_category['nama']]);
    
                    // Update category nama
                    $query = "UPDATE category SET nama = ? WHERE category_id = ?";
                    $updatedb = $connect->prepare($query);
                    $updatedb->execute([$votetitle, $update]);
                }

                if (isset($namajabatan)) {
                    // Update candidate voting_name
                    $query = "UPDATE candidate SET nama_jabatan = ? WHERE nama_jabatan = ?";
                    $update_candidate = $connect->prepare($query);
                    $update_candidate->execute([$votetitle, $fetch_category['nama_jabatan']]);
    
                    // Update category nama
                    $query = "UPDATE category SET nama = ? WHERE category_id = ?";
                    $updatedb = $connect->prepare($query);
                    $updatedb->execute([$votetitle, $update]);
                }
    
                if (isset($status)) {
                    // Update category status
                    $query = "UPDATE category SET status = ? WHERE category_id = ?";
                    $updatedb = $connect->prepare($query);
                    $updatedb->execute([$status, $update]);
                }
    
                if (isset($detail)) {
                    // Update category details
                    $query = "UPDATE category SET details = ? WHERE category_id = ?";
                    $updatedb = $connect->prepare($query);
                    $updatedb->execute([$detail, $update]);
                }
    
                if (isset($start)) {
                    // Update category start_tggl
                    $query = "UPDATE category SET start_tggl = ? WHERE category_id = ?";
                    $updatedb = $connect->prepare($query);
                    $updatedb->execute([$start, $update]);
                }
    
                if (isset($end)) {
                    // Update category end_tggl
                    $query = "UPDATE category SET end_tggl = ? WHERE category_id = ?";
                    $updatedb = $connect->prepare($query);
                    $updatedb->execute([$end, $update]);
                }
    
                flash_alert('Message', 'Berhasil mengubah kategori!', FLASH_SUCCESS);
                header('refresh:3;url=category.php');
            }
        }
    }
    
?>
<!-- detail -->
<?php

if(isset($_GET['delete_detail'])){
    $delete_id = $_GET['delete_detail'];

    $query = "UPDATE candidate SET voting_name = '' WHERE id = '$delete_id'";
    $update_candidate = $connect->prepare($query);
    $update_candidate -> execute();


    if ($jumlah_calon == 1) {
        $query = "UPDATE category SET jml_calon = 0, status ='Inactive' WHERE category_id = $detail";
        $update_category = $connect->prepare($query);
        $update_category -> execute();
        flash_alert('Message', 'Berhasil menghapus calon dari kategori!', FLASH_SUCCESS);
    } else {
        $query = "SELECT nama_calon, nama_wakil FROM candidate WHERE id = '$delete_id'";
        $get_candidate = $connect->prepare($query);
        $get_candidate -> execute();
        $fetch_candidate = $get_candidate->fetch(PDO::FETCH_ASSOC);


        $jumlah_calon = $jumlah_calon -1;
        $query = "UPDATE category SET jml_calon = $jumlah_calon WHERE category_id = $detail";
        $update_category = $connect->prepare($query);
        $update_category -> execute();
        flash_alert('Message', 'Berhasil menghapus calon dari kategori!', FLASH_SUCCESS);
    }

}?>


<!-- admin -->
<!-- add -->
<?php
    if(isset($_POST['add-admin'])){
        $nama_admin = $_POST['admin_nama'];
        $username_admin = $_POST['admin_username'];
        $password_admin = $_POST['admin_password'];
        $cpassword_admin = $_POST['admin_cpassword'];

        $check_user = $connect->prepare("SELECT * FROM admin WHERE username = ?");
        $check_user -> execute([$username_admin]);

        if($check_user->rowCount() > 0) {
            flash_alert('Message','Gagal mendaftar! Username sudah terdaftar!', FLASH_DANGER);
        } else if ($cpassword_admin != $password_admin){
            flash_alert('Message','Gagal mendaftar!  Salah konfirmasi kata sandi!', FLASH_DANGER);
        }
        else {
            $query = "INSERT INTO admin (nama_admin, username, password) VALUES (?, ?, ?)";
            $insert_user = $connect->prepare($query);
            $insert_user -> execute([$nama_admin, $username_admin, $password_admin]);
            flash_alert('Message', 'Berhasil mendaftarkan admin baru!', FLASH_SUCCESS);
        }

    }

?>

<!-- delete -->

<?php
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
    
        $query="DELETE FROM admin WHERE admin_id = ?";
        $del_category = $connect->prepare($query);
        $del_category -> execute([$delete_id]);

        flash_alert('Message', 'Berhasil menghapus admin!', FLASH_SUCCESS);
    }
?>

<!-- update -->
<?php
    if (isset($_POST['update-admin'])) {
        $id = $_SESSION['admin_id'];
    
        $changes = 0;
    
        // Update nama_admin if provided
        if (!empty($_POST['admin_nama']) && ($_POST['admin_nama'] != $_SESSION['nama_admin'])) {
            $nama_admin = $_POST['admin_nama'];
            $query = "UPDATE admin SET nama_admin = ? WHERE admin_id = ?";
            $updatedb = $connect->prepare($query);
            $updatedb->execute([$nama_admin, $id]);
    
            $_SESSION['nama_admin'] = $nama_admin;
            $admin_name = $nama_admin;
            $changes++;
        }
    
        // Update username_admin if provided and not taken
        if (!empty($_POST['admin_username']) && ($_POST['admin_username'] != $_SESSION['admin_username'])) {
            $username_admin = $_POST['admin_username'];
    
            $check_user = $connect->prepare("SELECT * FROM admin WHERE username = ?");
            $check_user->execute([$username_admin]);
    
            if ($check_user->rowCount() > 0) {
                flash_alert('Message', 'Username ini sudah terdaftar!', FLASH_DANGER);
                $changes = 0;
            } else {
                $query = "UPDATE admin SET username = ? WHERE admin_id = ?";
                $updatedb = $connect->prepare($query);
                $updatedb->execute([$username_admin, $id]);
    
                $_SESSION['admin_username'] = $admin_username = $username_admin;
                $changes++;
            }
        }
    
        // Update password if provided
        $currentpassword_admin = $_POST['admin_currentpassword'];
        $password_admin = $_POST['admin_password'];
        $cpassword_admin = $_POST['admin_cpassword'];
    
        if (!empty($currentpassword_admin) && !empty($password_admin) && !empty($cpassword_admin)) {
            if ($password_admin != $cpassword_admin) {
                flash_alert('Message', 'Konfirmasi kata sandi tidak cocok.', FLASH_DANGER);
                $changes = 0;
            } else {
                $check_pw = $connect->prepare("SELECT password FROM admin WHERE admin_id = ?");
                $check_pw->execute([$id]);
                $fetch_pw = $check_pw->fetch(PDO::FETCH_ASSOC);
    
                if ($currentpassword_admin != implode($fetch_pw)) {
                    flash_alert('Message', 'Kata sandi saat ini yang Anda masukkan salah!', FLASH_DANGER);
                $changes = 0;
                } else {
                    $query = "UPDATE admin SET password = ? WHERE admin_id = ?";
                    $updatedb = $connect->prepare($query);
                    $updatedb->execute([$password_admin, $id]);
                    $changes++;
                }
            }
        } elseif (!empty($currentpassword_admin) || !empty($password_admin) || !empty($cpassword_admin)) {
            flash_alert('Message', 'Harap masukkan semua bidang kata sandi untuk mengubah kata sandi Anda!', FLASH_DANGER);
            $changes = 0;

        }
    
            if ($changes > 0) {
                flash_alert('Message', 'Anda berhasil mengubah data.', FLASH_SUCCESS);

            }
    }
    
?>

<!-- user -->
<!-- delete -->
<?php
    if(isset($_GET['delete_user'])){
        $delete_id = $_GET['delete_user'];
    
        $query="DELETE FROM users WHERE user_id = ?";
        $del_category = $connect->prepare($query);
        $del_category -> execute([$delete_id]);


    
        $query="DELETE FROM votes WHERE user_id = ?";
        $del_votes = $connect->prepare($query);
        $del_votes -> execute([$delete_id]);

        flash_alert('Message', 'Berhasil menghapus user!', FLASH_SUCCESS);
    }
?>
<!-- update -->
<?php
    if(isset($_GET['update_status'])){
        $update = $_GET['update_status'];
        $uid = $_GET['uid'];

        $query = "SELECT email from users WHERE user_id = $uid";
        $get_email = $connect->prepare($query);
        $get_email -> execute();
        $fetch = $get_email -> fetch(PDO::FETCH_ASSOC);
        $email = $fetch['email'];

        if ($update == "verified") {
            
            $query = "UPDATE users SET status = '$update' WHERE user_id = $uid";
            $updatedb = $connect->prepare($query);
            $updatedb -> execute();
            sendEmail($email);

            flash_alert('Message','User telah diverifikasi!',FLASH_SUCCESS);
            header('refresh:3;url=user.php');

        } else if ($update == "rejected") {
            sendEmail_rejection($email);

            $query="DELETE FROM users WHERE user_id = ?";
            $del_category = $connect->prepare($query);
            $del_category -> execute([$uid]);

            flash_alert('Message','User telah ditolak!',FLASH_DANGER);
            header('refresh:3;url=user.php');
        }
    }

?>

<!-- detail -->
<?php
    if(isset($_POST['cancel'])){
        header('location:user.php');
    } else if(isset($_POST['verify'])){
        $query = "UPDATE users SET status = 'verified' WHERE user_id = $uid";
        $updatedb = $connect->prepare($query);
        $updatedb -> execute();

        $query="SELECT email FROM users WHERE user_id = ?";
        $get_user = $connect->prepare($query);
        $get_user -> execute([$uid]);
        $fetch_user = $get_user -> fetch(PDO::FETCH_ASSOC);
        $email = $fetch_user['email'];

        sendEmail($email);
        
        flash_alert('Message','User telah diverifikasi!',FLASH_SUCCESS);
        header('refresh:0;url=user.php');
    } else if(isset($_POST['reject'])){
        
        $query="SELECT email FROM users WHERE user_id = ?";
        $get_user = $connect->prepare($query);
        $get_user -> execute([$uid]);
        $fetch_user = $get_user -> fetch(PDO::FETCH_ASSOC);

        $email = $fetch_user['email'];
        sendEmail_rejection($email);

        $query="DELETE FROM users WHERE user_id = ?";
        $del_user = $connect->prepare($query);
        $del_user -> execute([$uid]);

        flash_alert('Message','User telah ditolak!',FLASH_DANGER);
        header('refresh:0;url=user.php');

    } else if(isset($_POST['delete'])){
    
        $query="DELETE FROM users WHERE user_id = ?";
        $del_user = $connect->prepare($query);
        $del_user -> execute([$uid]);

        $query="DELETE FROM votes WHERE user_id = ?";
        $del_votes = $connect->prepare($query);
        $del_votes -> execute([$uid]);

        flash_alert('Message', 'Berhasil menghapus user!', FLASH_SUCCESS);
        header('refresh:0;url=user.php');


    }
?>






<!-- prevote -->
<!-- import csv -->
<?php
    if (isset($_POST["import"])) {
        // Check if a file is selected
        if ($_FILES["csvfile"]["error"] == UPLOAD_ERR_OK && is_uploaded_file($_FILES["csvfile"]["tmp_name"])) {
            // Temporary file path
            $csvFile = $_FILES["csvfile"]["tmp_name"];
    
            try {
                // Create a new PDO instance
    
                // Set the PDO error mode to exception
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                // Open the CSV file
                $handle = fopen($csvFile, "r");
    
                // Get the header row to determine the number of columns and column names
                $header = fgetcsv($handle);
                $numColumns = count($header);
    
                $filename = pathinfo($_FILES["csvfile"]["name"], PATHINFO_FILENAME);
    
                // Generate a unique table name
                $tableName = "prevote_" . $filename ;
    
                
    
                // Create the new table
                $createTableSql = "CREATE TABLE $tableName (";
                $createTableSql .= implode(" VARCHAR(255), ", $header) . " VARCHAR(255))";
                $connect->exec($createTableSql);
    
                // Prepare the SQL INSERT statement
                $sql = "INSERT INTO $tableName (";
                $sql .= implode(", ", $header);
                $sql .= ") VALUES (";
                $sql .= implode(", ", array_fill(0, $numColumns, "?"));
                $sql .= ")";
                $stmt = $connect->prepare($sql);
    
                // Bind parameters dynamically
                $params = array();
                for ($i = 0; $i < $numColumns; $i++) {
                    $params[$i] = null;
                    $stmt->bindParam($i + 1, $params[$i]);
                }
    
                // Read the CSV data and insert into the new table
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    for ($i = 0; $i < $numColumns; $i++) {
                        $params[$i] = $data[$i];
                    }
    
                    // Execute the INSERT statement
                    $stmt->execute();
                }
    
                // Close the file handle
                fclose($handle);
    
                $query = "INSERT INTO prevoting (table_name) VALUES ('$tableName')";
                $insert = $connect->prepare($query);
                $insert->execute();
    
                flash_alert('Message', 'Data CSV telah berhasil diunggah menjadi tabel '.$tableName.'', FLASH_SUCCESS);
            
    
    
            } catch (PDOException $e) {
                $emessage = "Error: " . $e->getMessage();
                flash_alert('Message', $emessage, FLASH_DANGER);

            }
        } else {
            flash_alert('Message', 'Silakan pilih file CSV yang valid', FLASH_DANGER);

        }
    }
    
?>

<!-- prevote  -->
<?php
    if(isset($_POST['prevote'])){
        $tableName = $_POST['prevote'];
    
        if($tableName!=""){
            $kandidat = getCandidateNames($tableName);
            $hasil = posteriorProbability($tableName, $kandidat);
        
            $candidate = array();
            $prob = array();
        
            foreach($hasil as $key => $value){
        
                array_push($candidate, $key);
                array_push($prob, $value);
        
            }
        }
        
    }
?>

<!-- voting -->
<?php
if(!isset($_GET['daftarvote']) || $_GET['daftarvote'] == '--'){
    $category_name='--';
} else {
    $category_name = $_GET['daftarvote'];
    $getting_candidate = $connect->prepare("SELECT nama_calon, nama_wakil FROM candidate WHERE voting_name = ?");
    $getting_candidate -> execute([$category_name]);
    $number_of_candidate = $getting_candidate -> rowCount();

    if ($getting_candidate->rowCount()) {
        while($fetch_category = $getting_candidate->fetch(PDO::FETCH_ASSOC)){
            $calon[] = $fetch_category['nama_calon'];
            $wakil[] = $fetch_category['nama_wakil'];
        }
    }
    
}
?>