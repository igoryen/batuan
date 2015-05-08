<?php

$err_msgs = [];
$target_dir    = "uploads/"; #1
$target_file   = $target_dir . basename($_FILES["fileToUpload"]["name"]); #2
#TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT
echo '<pre>';
echo '$target_dir: ' .$target_dir. '<br>';
echo '$target_file: ' .$target_file. '<br>';
echo '</pre>';
#LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
$uploadOk      = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION); #3
$imageFileType = strtolower($imageFileType);
#TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT
echo '<pre>';
echo '$imageFileType: ' .$imageFileType. '<br>';
echo '</pre>';
#LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  #TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT
  echo '<pre>';
  echo '$_POST[submit]: ' .$_POST["submit"]. '<br>';
  echo 'due to < input type="submit" value="Upload Image" name="submit">' . '<br>';
  echo '</pre>';
#LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  #TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT
  echo '<pre>';
  echo '$check: ' . print_r($check). '<br>';
  echo '</pre>';
#LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
  if ($check !== false) {
    array_push ($err_msgs, "OK, file is an image - " . $check["mime"] . ".");
    $uploadOk = 1;
  }
  else {
    array_push ($err_msgs, "Oops, file is not an image.");
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  array_push ($err_msgs, "Sorry, file already exists.");
  $uploadOk = 0;
}

 // Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  array_push ($err_msgs, "Sorry, your file is too large.");
  $uploadOk = 0;
} 

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
  array_push ($err_msgs, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
  $uploadOk = 0;
} 

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  array_push ($err_msgs,"Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
}
else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    array_push ($err_msgs, "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.");
  }
  else {
    array_push ($err_msgs, "Sorry, there was an error uploading your file.");
  }
}

echo "<mark>";
foreach ($err_msgs as $msg) {
  echo $msg . "<br>";
}
echo "</mark>";
