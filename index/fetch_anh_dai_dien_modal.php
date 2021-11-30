<?php
require_once('dbConnection.php');
$userid = '1';
                                                $query = "SELECT *, @rank :=  @rank + 1 AS rank_av FROM gallery g left join post p on p.ID = g.postid, (SELECT  @rank := 0) r where membersid = '{$userid}' and gallerycategoryid = '9' ORDER BY g.id DESC";
                                                $result = mysqli_query($connect, $query);

                                                while ($row = mysqli_fetch_array($result)) {?>

                                            <div class="carousel-item " id="<?php echo 'itemdd', $row['rank_av']; ?>">
                                                <img src="../images/<?php echo $row['url'] ?>" class="rounded-3"
                                                    alt="">
                                            </div>

<?php }?>
<script>
        $(document).ready(function() {
            $(this).find("#itemdd1").addClass("active");
        });
</script>