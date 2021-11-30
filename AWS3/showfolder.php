<?php
include 'configAWS3.php';
// $objects = $s3->ListObjects(['Bucket' => 'datdia', 'Delimiter'=>'/', 'Prefix' => '2021/08']);
/*  check file  */
// $filename = 'duydevtests3-28082021.jpg';
// $response = $s3->doesObjectExist($bucket, $filename);
$imgurl1 = "158364755_938242553598572_6255459073316320113_n.mp4";
$fileExtensionvideo = ['m4v', 'avi', 'mpg', 'mp4'];
$file_type = ltrim(strstr($imgurl1,"."),".");
foreach ($fileExtensionvideo as $key => $val) {
    if($file_type == $fileExtensionvideo[$key])
    {
        echo true;
    }
}
var_dump($file_type,$fileExtensionvideo,array_key_exists($file_type, $fileExtensionvideo));
?> <br> <?php
$folder = 'duy_dev';
$response = $s3->ListObjects(['Bucket' => $bucketName,'Prefix' => $folder]);
if (isset($response['Contents'])) {
    $result = $s3->listObjects(array('Bucket' => $bucketName, 'MaxKeys' => 10000,'Prefix' => $folder));
    $files = $result->getPath('Contents');
    foreach ($files as $file) {
        $filename = $file['Key'];
        print "\n\nFilename:" . $filename;?></br><?php
}
} else {
    echo "NULL";
}
?>