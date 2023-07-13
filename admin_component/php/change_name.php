<?php
if (isset($_GET['change_id'])) {
  
  $sql = "SELECT id_user, nama_lama, nama_baru FROM ganti_nama WHERE id = $_GET[change_id]";

  $stmt = $connect->prepare($sql);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_id = $row['id_user'];
    $namaBaru = $row['nama_baru'];

    $query = "UPDATE users SET nama = '$namaBaru' WHERE user_id = $user_id";
    $updatedb = $connect->prepare($query);
    $updatedb->execute();

    $query = "DELETE FROM ganti_nama WHERE id = $_GET[change_id]";
    $updatedb = $connect->prepare($query);
    $updatedb->execute();

    $query = "SELECT email FROM users WHERE user_id = $user_id";
    $GET_EMAIL = $connect->prepare($query);
    $GET_EMAIL->execute();
    $fetch = $GET_EMAIL->fetch(PDO::FETCH_ASSOC);

    sendEmailChangeName($fetch['email'],"berhasil");
    flash_alert('Message', 'Pengubahan nama user telah diterima!', FLASH_SUCCESS);

  }
} else if (isset($_GET['delete_id'])){
    $sql = "SELECT id_user FROM ganti_nama WHERE id = $_GET[delete_id]";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_id = $row['id_user'];
    
    $query = "SELECT email FROM users WHERE user_id = $user_id";
    $GET_EMAIL = $connect->prepare($query);
    $GET_EMAIL->execute();
    $fetch = $GET_EMAIL->fetch(PDO::FETCH_ASSOC);
    sendEmailChangeName($fetch['email'],"tidak berhasil");
    flash_alert('Message', 'Pengubahan nama user telah ditolak!', FLASH_SUCCESS);

    $query = "DELETE FROM ganti_nama WHERE id = $_GET[delete_id]";
    $updatedb = $connect->prepare($query);
    $updatedb->execute();

}
?>
