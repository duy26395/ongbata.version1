<?php

include 'Connect.php';
$path = "../images/";
$idtypegallery = 'imgcover';


//use session get id userlogin
$userid = '1';

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    switch ($method) {
        case "Loadingcover":
             $query = "SELECT
             g.id,g.url,g.datecreate,g.gallerytype,
             ROW_NUMBER() OVER (PARTITION BY g.gallerytype ORDER BY g.datecreate DESC) as R
         FROM gallery g left join post p on g.postid = p.id
         left join members m on p.membersid = m.ID
         where m.ID = '{$userid}' and gallerytype = '{$idtypegallery}' LIMIT 1";

            $result = mysqli_query($connect, $query);
                                                            
            while ($row = mysqli_fetch_array($result)){?>

<img src="../images/<?php echo $row['url'];?>" class="rounded-3" id="anh_bia">

<?php  }  ?>
<script>
document.getElementById('anh_bia').addEventListener('click', function() {
    toggleFullscreen(this);
});
</script> <?php
        break;
        case "Uploadimgcover":
            if (isset($_FILES['multipleFile3'])) {
                if (isset($_POST['id'])) {$lastidimg = $_POST['id'];}
                foreach ($_FILES['multipleFile3']['name'] as $key => $val) {
                    // File upload path
                    $fileNameimg = $_FILES['multipleFile3']['name'][$key];
                    // echo $fileName;
                    $sqlinsertimgpost = "INSERT INTO `gallery`(`postid`, `url`, `datecreate`, `gallerytype`) VALUES ('{$lastidimg}','{$fileNameimg}',unix_timestamp(),'{$idtypegallery}')";
                    $connect->query($sqlinsertimgpost);
                    move_uploaded_file($_FILES['multipleFile3']['tmp_name'][$key], $path . $fileNameimg);
            
                }
            }
            break;
        }
    }
?>