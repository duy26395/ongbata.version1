<?php 
include 'configAWS3.php';

$result = array();
try {
 $rs = $s3->putObject(array( 
    'Bucket' => $bucketName,
    'Key'    => $folder."/",
    'Body'   => "",
    'ACL'    => 'public-read'
   ));
   var_dump($rs);
   $result['success'] = true;
}
catch (S3Exception $e) {
    die('Error:' . $e->getMessage());
    $result['success'] = false;
    $result['name'] = 'Error:' . $e->getMessage();

}

?>