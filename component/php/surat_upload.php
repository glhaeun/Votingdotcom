<?php
if (isset($_POST['kirim_surat'])) {
    if ($_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        if ($_FILES['pdf']['type'] !== 'application/pdf') {
            ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
            swal({
                title: "Gagal!",
                text: "Format surat anda harus dalam bentuk PDF",
                icon: "error"
            });      
            </script>
            <?php
        } else {
            $namaBaru = $_POST['nama_baru'];

            if ($namaBaru != $_SESSION['user_name']) {
                // Check if a previous entry exists and delete it
                $query = "SELECT * FROM ganti_nama WHERE id_user = $_SESSION[user_id]";
                $check = $connect->prepare($query);
                $check->execute();

                if ($check->rowCount() > 0) {
                    $query = "DELETE FROM ganti_nama WHERE id_user = $_SESSION[user_id]";
                    $check = $connect->prepare($query);
                    $check->execute();
                }
            }
            
            $fileTmpPath = $_FILES['pdf']['tmp_name'];
            $fileName = $_FILES['pdf']['name'];
            $fileSize = $_FILES['pdf']['size'];
            $destinationFolder = '../surat/';
            $destinationPath = $destinationFolder . $fileName;

            if (move_uploaded_file($fileTmpPath, $destinationPath)) {

                    // Read the file content
                    $fileContent = file_get_contents($destinationPath);

                    // Prepare the SQL statement
                    $sql = "INSERT INTO ganti_nama (id_user, nama_lama, nama_baru, nama_file, konten_file) VALUES (:id_user, :nama_lama, :nama_baru, :nama_file, :konten_file)";

                    // Execute the SQL statement
                    $stmt = $connect->prepare($sql);
                    $stmt->bindParam(':id_user', $_SESSION['user_id']);
                    $stmt->bindParam(':nama_lama', $_SESSION['user_name']);
                    $stmt->bindParam(':nama_baru', $namaBaru);
                    $stmt->bindParam(':nama_file', $fileName);
                    $stmt->bindParam(':konten_file', $fileContent);
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
                }
             else {
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
        }
    }
}
?>