<?php
include 'configAWS3.php';
$pathAMS3 = 'https://labtoidayhoc.s3.ap-southeast-1.amazonaws.com/'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AWS</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">
        <input id="img" type="file" name="files[]" multiple>
    </form>
    <input id="add" type="submit" name="add" value="Submit">
    <button id="addfolder">addfolder</button>
    <ul>
        <?php
$response = $s3->ListObjects(['Bucket' => $bucketName, 'Prefix' => $folder]);
if (isset($response['Contents'])) {
    $result = $s3->listObjects(array('Bucket' => $bucketName, 'MaxKeys' => 10000, 'Prefix' => $folder));
    $files = $result->getPath('Contents');
    foreach ($files as $file) {
        $filename = $file['Key'];
        ?>
        <li data-id="<?=$filename?>">
            <img src="<?=$pathAMS3.$filename?>" width="80px" height="60px"
                alt="">
            <button class="deletefile">deletefile</button>
        </li>
        <?php
// print "\n\nFilename:" . $filename;
    }
} else {
    echo "NULL";
}

?>

    </ul>
</body>
<script>
$(document).ready(function() {
    $("#add").on("click", function(e) {
        var file_data = new FormData();

        // Read selected files
        var fi = document.getElementById('img');
        for (var i = 0; i < fi.files.length; i++) {
            file_data.append("files[]", fi.files[i]);
        }
        // file_data.append('fileToUpload', file_data);
        console.log(file_data);
        $.ajax({
            url: 'Updateloadfile.php',
            type: 'POST',
            data: file_data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                alter(data.success)
                alter(data.name)
            }
        });
    });
    $("#addfolder").on("click", function(e) {
        $.ajax({
            url: 'Createfolder.php',
            type: 'POST',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                alter(data.success)
                alter(data.name)
            }
        });

    });
    $(".deletefile").on("click", function(e) {
        var temp = $(this).parent().attr("data-id")
        var name = temp.split('/').pop().toLowerCase()
        var folder = temp.split('/').shift();
        console.log(name, folder);
        $.ajax({
            url: 'delete.php',
            type: 'POST',
            // data: {
            //     name : name,
            //     folder : folder
            // },
            data: {
                url: temp
            },
            cache: false,
            dataType: 'json',
            success: function(data) {
                alter(data.success)
                alter(data.name)
            }
        });
    })

})
</script>

</html>