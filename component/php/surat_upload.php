<?php
if(isset($_POST['kirim_surat'])){

    $namaBaru = $_POST['nama_baru'];

if ($_FILES['docx_file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['docx_file']['tmp_name'];
    $fileName = $_FILES['docx_file']['name'];
    $fileSize = $_FILES['docx_file']['size'];
  
    // Define the destination folder path
    $destinationFolder = 'D:/xampp/htdocs/Votingdotcom/surat/';
  
    // Move the uploaded file to the destination folder
    $destinationPath = $destinationFolder . $fileName;
    if (move_uploaded_file($fileTmpPath, $destinationPath)) {
      // File moved successfully, continue with database insertion
  
      // Read the file content
      $fileContent = file_get_contents($destinationPath);
  
      // Prepare the SQL statement
      $sql = "INSERT INTO ganti_nama (id_user, nama_lama, nama_baru, nama_file) VALUES (:id_user, :nama_lama, :nama_baru, :nama_file)";
  
      // Execute the SQL statement
      $stmt = $connect->prepare($sql);
      $stmt->bindParam(':id_user', $_SESSION['user_id']);
      $stmt->bindParam(':nama_lama', $_SESSION['user_name']);
      $stmt->bindParam(':nama_baru', $namaBaru);
      $stmt->bindParam(':nama_file', $fileName, PDO::PARAM_LOB);
      $stmt->execute();
  
      ?>
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
         <script>
         swal({
             title: "Berhasil!",
             text: "Silakan tunggu konfirmasi dari admin dalam 24 jam",
             icon: "success",
             
         }).then(function() {
             window.location = "landing.php";
         });      
         </script>
         <?php
    } else {
        ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
        swal({
            title: "Gagal!",
            text: "Gagal mengunggah surat anda",
            icon: "error",
            
        });      
        </script>
        <?php
    }
  } else {
    ?>
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
         <script>
         swal({
            title: "Gagal!",
            text: "Gagal mengunggah surat anda",
            icon: "error"
             
         });      
         </script>
         <?php
  }
}
  ?>