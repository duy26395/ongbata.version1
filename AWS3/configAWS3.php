<?php 
require '../vendor/autoload.php';

use Aws\S3\S3Client;

/*  AWS Info */
// $bucketName = 'labtoidayhoc';
// // $bucketName = 'datdia';
// $IAM_KEY = 'AKIAVJH5OBNALLPJXXNB';
// $IAM_SECRET = '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';
$folder = 'duy_dev';
$s3 = S3Client::factory(
    array(
        'credentials' => array(
            'key' => $IAM_KEY,
            'secret' => $IAM_SECRET,
        ),
        'version' => 'latest',
        'region' => 'ap-southeast-1',
    )
);


?>
