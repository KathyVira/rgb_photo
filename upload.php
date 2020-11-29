<?php
// https://www.w3schools.com/php/php_file_upload.asp
//https://www.php.net/manual/en/function.imagecolorclosest.php

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$massage = '';
$imageName;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

  define('UPLOAD_MAX_SIZE', 1024 * 1024 * 20);
  $ex = ['jpg', 'jpeg', 'png', 'gif', 'bpm', 'pdf', 'doc', 'docx'];

  if (empty($_FILES['fileToUpload']['name'])) {
$massage = "no image";
exit;
  }
  if (!is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
    $massage = "Sorry, your file was not uploaded.";
    exit;
  }
  if (!$_FILES['fileToUpload']['size'] <= UPLOAD_MAX_SIZE && !$_FILES['fileToUpload']['error'] == 0) {
    $massage = "Sorry, your file was not uploaded.";
    exit;
  }

  $file_info = pathinfo($_FILES['fileToUpload']['name']);
  $file_ex = strtolower($file_info['extension']);

  if (!in_array($file_ex, $ex)) {
    $massage = "Sorry, your file was not uploaded.";
    exit;
  }

  move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "images/" . $_FILES['fileToUpload']['name']);
  $imageName = $_FILES['fileToUpload']['name'];

    
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright 
  https://www.w3schools.com/bootstrap/bootstrap_theme_me.asp-->
  <title>Bootstrap Theme Simply Me</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  body {
    font: 20px Montserrat, sans-serif;
    line-height: 1.8;
    color: #f5f6f7;
  }
  p {font-size: 16px;}
  .margin {margin-bottom: 45px;}
  
  .bg-2 { 
    background-color: #474e5d; /* Dark Blue */
    color: #ffffff;
  }
  .bg-3 { 
    background-color: #ffffff; /* White */
    color: #555555;
  }
 
  .container-fluid {
    padding-top: 70px;
    padding-bottom: 70px;
  }
  .navbar {
    padding-top: 15px;
    padding-bottom: 15px;
    border: 0;
    border-radius: 0;
    margin-bottom: 0;
    font-size: 12px;
    letter-spacing: 5px;
  }
  .navbar-nav  li a:hover {
    color: #1abc9c !important;
  }
  .color-box{
    background-color: red;
    height: 100px;
    width:150px;
  }
  
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-default bg-2">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>            
      </button>
      <a class="navbar-brand" href="http://www.kathyvira.com">Me</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">Home</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- First Container -->

<div class="container-fluid bg-3 text-center">
  <div class="row content justify-content-sm-center">


  <h3 class="margin "><?= $massage ?></h3>
  <h3 class="margin">RGB colors</h3>
<div class="col-sm-12">
    <div class="col-sm-9">
      <img src="images/<?=$imageName?>" class="img-responsive" style="display:inline; height:500px !important" alt="<?=$imageName?>" width="auto" height="500">
    </div>

    <div class="col-sm-3">
    <?php
    
    $imgSrc = imagecreatefromjpeg($target_dir.$imageName);

    similarColor($imgSrc);

    function similarColor($imgSrc){
      $pixelHeight;
      $pixelWidth;
      $imgHeight = imagesx($imgSrc);
      $imgWidth = imagesy($imgSrc);

      $imgPalette = imagetruecolortopalette($imgSrc, false, 255); //???


      for ($pixelHeight=0; $pixelHeight <=  $imgHeight-1; $pixelHeight++) { 
        for ($pixelWidth=0; $pixelWidth <=  $imgWidth-1; $pixelWidth++) { 
         
          $rgb = imagecolorat($imgSrc, $pixelHeight , $pixelWidth); //return index of specific pixel

         if(!isset($arrayColors)){
          $arrayColors[] = $rgb;
        }
        array_push($arrayColors, $rgb); //pushing all colors to arrayColors 
      }
      
    }
    
  
    $countAllColors = array_count_values($arrayColors);
    
    
    arsort($countAllColors);
    
    // print_r($countAllColors);
    
    
    $newArray = array_slice($arrayColors, 0, 5, true);
    
    // print_r($newArray);
    
    for ($i=0; $i < count($newArray); $i++) { 
      $rgb = array_keys($newArray);
     
      $colors = imagecolorsforindex($imgSrc, $rgb[$i]); //add indexes to array
           
            $red = $colors['red'];
            $green = $colors['green'];
            $blue = $colors['blue'];
            $alpha = $colors['alpha'];
     
            echo ('<div class="color-box" style="height: 100px; color:rgb('.(255-$red).','.(255-$green).','.(255-$blue).'); background-color:rgb('.$red.','.$green.','.$blue.')">rgb('.$red.','.$green.','.$blue.')</div>');
            
    }
    
    
    imagedestroy($imgSrc);
    }
    
 
      ?>

</div>
</div>
    
   
 

  <h3></h3>
</div>



</body>
</html>
