<?php


//https://www.php.net/manual/en/function.imagecolorclosest.php

    $target_dir = "images/";

    if(isset($_FILES["fileToUpload"]["name"])){

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    };
    $uploadOk = 1;
    $massage = '';
    $imageName;

    define('UPLOAD_MAX_SIZE', 1024 * 1024 * 20);
$ex = ['jpg', 'jpeg'];

if (isset($_POST['submit'])) {

    $title = "Your Image";
    $secTitle = "5 Popular Colors";

  if (!empty($_FILES['fileToUpload']['name'])) {

    if (is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {

      if ($_FILES['fileToUpload']['size'] <= UPLOAD_MAX_SIZE && $_FILES['fileToUpload']['error'] == 0) {
       
        $file_info = pathinfo($_FILES['fileToUpload']['name']);
        
       
        $file_ex = strtolower($file_info['extension']);

        if (in_array($file_ex, $ex)) {

          move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "images/".$_FILES['fileToUpload']['name']);
          $imageName = $_FILES['fileToUpload']['name'];
          $imgSrc = imagecreatefromjpeg($target_dir.$imageName);
        }else{
            $massage = "Sorry, your Image is invalid. only jpg or jpeg allowed";
            $title = "";
            $secTitle ="";
          }
      }
    }
  }else{
    $massage = "Sorry, there is no image.";
    $title = "";
    $secTitle ="";
  }
}else{
    $massage = "";
  }


function showFivePopularColors($imgSrc){
    $pixelHeight;
    $pixelWidth;
    $imgHeight = imagesx($imgSrc);
    $imgWidth = imagesy($imgSrc);
    $presentColors=0;

  imagetruecolortopalette($imgSrc, false, 255); //Turns an image into a palette * Simple colors

  

    for ($pixelHeight=0; $pixelHeight <=  $imgHeight-1; $pixelHeight++) { 
        for ($pixelWidth=0; $pixelWidth <=  $imgWidth-1; $pixelWidth++) {         
            $rgb = imagecolorat($imgSrc, $pixelHeight , $pixelWidth); //return rgb index of specific pixel
            
            if(!isset($allColors)){
                $allColors[] = $rgb;
            }
            array_push($allColors, $rgb); //pushing all colors to arrayColors 
            $presentColors++;
            // print_r($rgb);
            
        }     
    }    
    // print_r($allColors);
    
    $countAllRgb = array_count_values($allColors); // [key= RGB, val = number of copies]
    // print_r($countAllRgb);

    arsort($countAllRgb);  

  
    $onePresent = $presentColors / 100; 
    // echo  $onePresent;

  
    $topFive = array_slice($countAllRgb, 0, 5, true); 


    $fiveColors = array_values($topFive);
    // print_r($fiveColors);

    for ($i=0; $i < count($fiveColors); $i++) { 
        $rgb = array_keys($fiveColors);
    
        $colors = imagecolorsforindex($imgSrc, $rgb[$i]); //add indexes to array
        $presentOfColor = round(($fiveColors[$i]/$onePresent), 2);
        
        $red = $colors['red'];
        $green = $colors['green'];
        $blue = $colors['blue'];
        $alpha = $colors['alpha'];
    
        echo ('<div class="card-box m-4"><div class="color-box m-4" style="color:rgb('.(255-$red).','.(255-$green).','.(255-$blue).'); 
        background-color:rgb('.$red.','.$green.','.$blue.')">
        <br>'.$presentOfColor.'%
        </div>
    <div>rgb('.$red.','.$green.','.$blue.')</div></div>'); 
        
    }       
    imagedestroy($imgSrc);

}

?>