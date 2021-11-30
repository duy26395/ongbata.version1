<?php
include 'configAWS3.php';
include 'crudpost_AWS3.php';

$result = array();

if (isset($_FILES['files'])) {
    foreach ($_FILES['files']['name'] as $key => $val) {
        $fileNameimg = $_FILES['files']['name'][$key];
        $tempfileimg = $_FILES['files']['tmp_name'][$key];
        UploaddataAWS3($fileNameimg, $tempfileimg,$s3);
    }
}
// var_dump($s3);
// if (isset($_FILES['files'])) {
//     foreach ($_FILES['files']['name'] as $key => $val) {

//         $keyName = basename($_FILES["files"]['name'][$key]);
//         $file = $_FILES["files"]['tmp_name'][$key];

//         $finfo = new finfo(FILEINFO_MIME_TYPE);
//         $file_type = $finfo->file($file);
// // Add file it to S3
//         try {
//             // Uploaded:
//             $rs = $s3->putObject(
//                 array(
//                     'Bucket' => $bucketName,
//                     'Key' => $folder . '/' . $keyName,
//                     'ACL' => 'public-read',
//                     'ContentType' => $file_type,
//                     'SourceFile' => $file,
//                 )
//             );
//             $result['success'] = true;

//         } catch (S3Exception $e) {
//             die('Error:' . $e->getMessage());
//             $result['success'] = false;
//             $result['name'] = 'Error:' . $e->getMessage();

//         } catch (Exception $e) {
//             die('Error:' . $e->getMessage());
//             $result['success'] = false;
//             $result['name'] = 'Error:' . $e->getMessage();
//         }
//     }
//     echo json_encode($result);
// }

?>
