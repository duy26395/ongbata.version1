<?php
require_once('dbConnection.php');
//use session get id userlogin
$userid = '1';


$query = "SELECT *, @rank :=  @rank + 1 AS rank_av FROM gallery g left join post p on p.ID = g.postid, (SELECT  @rank := 0) r where membersid = '{$userid}' and gallerycategoryid = '7' ORDER BY g.id DESC;";

            $result = mysqli_query($connect, $query);
                                                            
            while ($row = mysqli_fetch_array($result)){?>

<div class="carousel-item " id="<?php echo 'active_acuaban', $row['rank_av']; ?>">
    <img src="../images/<?php echo $row['url'] ?>" class="rounded-3" alt="">
</div>

<?php  }  ?>



<!-- <script type='text/javascript' src="../javascript/jquery.js"></script> -->

<script>
        $(document).ready(function() {
            $(this).find("#active_acuaban1").addClass("active");
        });
</script>