<?php
require 'configAWS3.php';

function UploaddataAWS3($keyName, $file,$s3)
{
    $folder = 'duy_dev';
    $bucketName = 'labtoidayhoc';
    $result = array();
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $file_type = $finfo->file($file);
    // Add file it to S3
    try {
        // Uploaded:
        $rs = $s3->putObject(
            array(
                'Bucket' => $bucketName,
                'Key' => $folder . '/' . $keyName,
                'ACL' => 'public-read',
                'ContentType' => $file_type,
                'SourceFile' => $file,
                'Prefix' => $folder,
            )
        );
        $result['success'] = true;

    } catch (S3Exception $e) {
        die('Error:' . $e->getMessage());
        $result['success'] = false;
        $result['name'] = 'Error:' . $e->getMessage();

    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
        $result['success'] = false;
        $result['name'] = 'Error:' . $e->getMessage();
    }
}
function deletedataAWS3($url,$s3)
{
    $bucketName = 'labtoidayhoc';
    $folder = 'duy_dev';

    try {
        $rs = $s3->deleteObject(array(
            'Bucket' => $bucketName,
            'Key' => $url,
        ));
    } catch (S3Exception $e) {
        die('Error:' . $e->getMessage());
    }

}
