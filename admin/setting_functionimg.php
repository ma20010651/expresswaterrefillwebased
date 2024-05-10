<?php

function handleImageUpload($image, $imageName, $existingImagePath)
{
    $uploadDirectory = '../uploads/';
    
 
    if ($image['error'] == 0) {
       
        if (!empty($existingImagePath) && file_exists($existingImagePath)) {
            unlink($existingImagePath);
        }

        
        $fileName = basename($image['name']);
        $fileDestination = $uploadDirectory . $fileName;
        move_uploaded_file($image['tmp_name'], $fileDestination);

       
        return $fileDestination;
    } else {
       
        return $existingImagePath;
    }
}

?>