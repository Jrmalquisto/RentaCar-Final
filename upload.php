<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        if (isset($_FILES['file1'])) {
            $file = $_FILES['file'];
            $file_size = $_FILES['file']['size'];
            $file_name = $_FILES['file']['name'];
            $file_name_array = explode(".", $file_name); 
            $extension = end($file_name_array);
            $new_image_name ='Front_'. $file_name;

            $file1 = $_FILES['file1'];
            $file_size1 = $_FILES['file1']['size'];
            $file_name1 = $_FILES['file1']['name'];
            $file_name_array1 = explode(".", $file_name1); 
            $extension1 = end($file_name_array1);
            $new_image_name1 ='Back_' .$file_name1;

            if (($file1['error'] === UPLOAD_ERR_OK) && ($file['error'] === UPLOAD_ERR_OK)) {
                $uploadDir = 'images/shop/'; // Specify the directory where you want to save uploaded files
                $uploadPath = $uploadDir . $new_image_name;
                $uploadPath1 = $uploadDir . $new_image_name1;

                if ($file_size > 10000000) {
                    $error = 'Sorry, your image is too large. Upload less than 10 MB in size .';
                    echo json_encode($error);
                }
                else if ($file_size1 > 10000000) {
                    $error = 'Sorry, your image is too large. Upload less than 10 MB in size .';
                    echo json_encode($error);
                }
                else if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
                    && $extension!= "gif" && $extension!= "PNG" && $extension1= "JPG"  && $extension!= "JPEG") {
                    $error= "Front Photo - Sorry, only JPG, JPEG, and PNG files are allowed"; 
                    echo json_encode($error);
                }
                else if($extension1!= "jpg" && $extension1!= "png" && $extension1!= "jpeg"
                    && $extension1!= "gif" && $extension1!= "PNG" && $extension1!= "JPG"  && $extension1!= "JPEG") {
                    $error = "Back Photo - Sorry, only JPG, JPEG, and PNG files are allowed"; 
                    echo json_encode($error);
                
                               
                } else {

                    if (move_uploaded_file($file1['tmp_name'], $uploadPath1) && move_uploaded_file($file['tmp_name'], $uploadPath)) {
                        
                        $error = 'File uploaded successfully!';
                        echo json_encode($error);
                    } else {
                        $error = 'Failed to move the file.';
                        echo json_encode($error);
                    }

                }

            } else {
                $error =  'File upload failed with error code ' . $file1['error'];
                echo json_encode($error);
            }

        } else {
            $error =  'No file was uploaded.';
            echo json_encode($error);
        }

    } else {
        $error =  'No file was uploaded.';
        echo json_encode($error);
    }

} else {
    $error =  'Invalid request.';
    echo json_encode($error);
}
?>