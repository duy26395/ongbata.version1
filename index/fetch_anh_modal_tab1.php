<?php
include '../process/Connect.php';
//use session get id userlogin
$userid = '1';


$query = "SELECT *, @rank :=  @rank + 1 AS rank FROM gallery g left join post p on p.ID = g.postid, (SELECT  @rank := 0) r where membersid = '{$userid}' ORDER BY  g.id DESC LIMIT 9;";           

            $result = mysqli_query($connect, $query);
                                                            
            while ($row = mysqli_fetch_array($result)){?>

<div class="carousel-item " id="<?php echo 'active', $row['rank']; ?>">
    <img src="../images/<?php echo $row['url'] ?>" class="rounded-3" alt="">
</div>

<?php  }  ?>



<!-- <script type='text/javascript' src="../javascript/jquery.js"></script> -->

<script>
        $(document).ready(function() {
            $(this).find("#active1").addClass("active");
        });
</script>