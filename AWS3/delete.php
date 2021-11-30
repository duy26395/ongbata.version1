<?php
include 'configAWS3.php';
$pathfolder = 'duy_dev/';
if(isset($_POST['url'])) {
    $name = $_POST['url'];
}

// if(isset($_POST['name'])) {
//     $name = $_POST['name'];
// }
// if(isset($_POST['folder'])) {
//     $folder = $_POST['folder'];
// }
// $url = "duy_dev/duydev_test3.jpg";
// echo $url;
$url = $pathfolder.$name;
try {
        $rs = $s3->deleteObject(array(
            'Bucket' => $bucketName, 
            'Key' => $name
        ));
        var_dump($rs);
   }

   catch (S3Exception $e) {
       die('Error:' . $e->getMessage());
   }

?>