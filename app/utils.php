<?php

function uploadImageFile(string $file, string $subDir): string {
  $targetDir = "uploads/$subDir/";
  $targetFile = $targetDir . time() . '-' . $_SESSION['user_id'] . '-' . basename($file);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  $check = getimagesize($file['tmp_name']);
  if ($check === false) {
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($targetFile)) {
    $uploadOk = 0;
  }

  // Check file size
  if ($file['size'] > 500000) {
    $uploadOk = 0;
  }

  // Allow certain file formats
  if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    return 'Sorry, your file was not uploaded.';
  }

  // If everything is ok, try to upload file
  if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
    return 'Sorry, there was an error uploading your file.';
  }

  return 'The file ' . htmlspecialchars(basename($file)) . ' has been uploaded.';
}
