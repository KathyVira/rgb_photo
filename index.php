<?php

include "app/functions.php";

error_reporting(E_ERROR | E_PARSE);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <!-- Theme Made By www.w3schools.com - No Copyright 
      https://www.w3schools.com/bootstrap/bootstrap_theme_me.asp-->
      <title>Five colors</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/style.css">

    </head>
    <body>




<div class="container-fluid bg-3 text-center">
    <div class="row">
    <h3 class="margin">Select an image (jpg or jpeg)</h3>
        <form action="" method="post" enctype="multipart/form-data" class=>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div> 
</div>
<div class="container text-center error">
  <div class="row">
    <h3 class="margin p-3 mb-2  text-dark"><?php echo($massage) ?></h3>
  </div>
</div>

<div class="container bg-3 text-center">
    <div class="row content justify-content-sm-center">
            <div class="col-sm-12">
                <div class="col-sm-9 float-sm-left">
                    <h3 class="margin "><?= $title ?></h3>
                    <img src="images/<?=$imageName?>" class="img-responsive" style="display:inline; height:500px !important" alt="<?=$imageName?>" width="auto" height="500">
                </div>

                <div class="col-sm-3 float-sm-center pr-4">
                    <h3 class="margin "><?= $secTitle ?></h3>
                    <div class="rounded border ">
                              <?php  
                              
                              showFivePopularColors($imgSrc);
                              ?>
                    </div>
                  
            </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>