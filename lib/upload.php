<?php
$target_dir = "../uploads/";
$target_file = $target_dir . "sampleToTest.csv";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
// me la suda si existe, la idea es que pise el archivo
/*
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
*/

// Check file size
if ($_FILES["file-to-upload"]["size"] > 500000) {
    $result['result'] = 'error';
    $result['message'] = "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "csv") {
    $result['result'] = 'error';
    $result['message'] = "Sorry, only CSV are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $result['result'] = 'error';
    $result['message'] = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file-to-upload"]["tmp_name"], $target_file)) {
        $result['result'] = 'ok';
        $result['message'] = "The file ". basename( $_FILES["file-to-upload"]["name"]). " has been uploaded.";
    } else {
        $result['result'] = 'error';
        $result['message'] = "Sorry, there was an error uploading your file.";
    }
}
/*
$result['result'] = 'ok';
$result['message'] = 'ok';  
*/
echo json_encode($result);
?>