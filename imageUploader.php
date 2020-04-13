<?php

 $directory ='Asset/Images/';
        $imageUrl = $directory.$_FILES['file']['name'];
        $check = getimagesize($_FILES['file']['tmp_name']);
        if($imageUrl) {

            
                if( $_FILES['file']['size'] > 5124000 ) {
                    $_SESSION['msg']= "File size is too large. Maximum file size is 5mb";
                } else {
                    $fileType = pathinfo($imageUrl, PATHINFO_EXTENSION);
                    if($fileType == 'jpg'||$fileType == 'jepg'|| $fileType == 'JEPG' || $fileType == 'png'|| $fileType == 'JPG' || $fileType == 'PNG'|| $fileType == 'docx'|| $fileType == 'pdf') {
                        move_uploaded_file($_FILES['file']['tmp_name'], $imageUrl);
                        $finalimage=$imageUrl;
                    } else {
                        $_SESSION['msg']="File type not valid.";
                    }
                }
            
        } else {
           $_SESSION['msg']= "Please use a n valid file to upload";
        }
		
