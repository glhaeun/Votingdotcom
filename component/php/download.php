<?php
if (isset($_POST['download_template'])) {
  $templateFile = 'D:\xampp\htdocs\Votingdotcom\component\template.docx';
  $filename = 'template.docx';

  // Set appropriate headers for file download
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="' . $filename . '"');
  header('Content-Length: ' . filesize($templateFile));

  // Read and output the template file
  readfile($templateFile);
  exit();
}
?>