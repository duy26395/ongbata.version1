<?php

include 'Connect.php';
$path = "../images/";
//use session get id userlogin
$userid = '1';

            if (isset($_FILES['multipleFile3'])) {
                if (isset($_POST['id'])) {$lastidimg = $_POST['id'];}
                foreach ($_FILES['multipleFile3']['name'] as $key => $val) {
                    // File upload path
                    $fileNameimg = $_FILES['multipleFile3']['name'][$key];
                    // echo $fileName;
                    $sqlinsertimgpost = "INSERT INTO `gallery`(`postid`, `url`, `datecreate`, `gallerycategoryid`) VALUES ('{$lastidimg}','{$fileNameimg}',unix_timestamp(),'7')";
                    $connect->query($sqlinsertimgpost);
                    move_uploaded_file($_FILES['multipleFile3']['tmp_name'][$key], $path . $fileNameimg);
            
                }
            }
       

?>