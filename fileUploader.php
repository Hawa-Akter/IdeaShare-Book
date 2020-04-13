<?php

 $directory ='Asset/Images/';
        $imageUrl = $directory.$single;
       $check = getimagesize($multipletemp);
        if($imageUrl) {

            
                
                    $fileType = pathinfo($imageUrl, PATHINFO_EXTENSION);
                    if($fileType == 'jpg' || $fileType == 'png'|| $fileType == 'JPG' || $fileType == 'PNG'|| $fileType == 'docx'|| $fileType == 'pdf') {
                        move_uploaded_file($multipletemp, $imageUrl);
                        $finalimage=$imageUrl;
                    } else {
                        $_SESSION['msg']="File type not valid. Please upload jpg or png file";
                    }
                }
            
         
		
