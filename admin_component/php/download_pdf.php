<?php

include '../../admin_component/php/connect.php';

if (isset($_GET['file_id'])) {

  $fileId = $_GET['file_id'];

  // Prepare the SQL statement
  $sql = "SELECT nama_file, konten_file FROM ganti_nama WHERE id = :file_id";

  // Execute the SQL statement
  $stmt = $connect->prepare($sql);
  $stmt->bindParam(':file_id', $fileId);
  $stmt->execute();

  // Fetch the file details
  $file = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($file) {
    $fileName = $file['nama_file'];
    $fileContent = $file['konten_file'];
    $folder = "../component/"; // Specify the folder path with escaped backslashes

    // Set appropriate headers for file download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Length: ' . strlen($fileContent));

    // Output the file content
    echo $fileContent;

    // Save the file to the specified folder
    $destinationPath = $folder . $fileName;
    file_put_contents($destinationPath, $fileContent);
  }
} else {
  echo "Invalid file ID.";
}
?>
