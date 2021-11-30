<?php
require_once('dbConnection.php');
$userid = '1';   
                                            $query = "SELECT *, @rank :=  @rank + 1 AS rank_ab  FROM gallery g left join post p on p.ID = g.postid, (SELECT  @rank := 0) r where membersid = '{$userid}' and gallerycategoryid = '10' ORDER BY g.id DESC;";
                                            $result = mysqli_query($connect, $query);
                                                                                            
                                            while ($row = mysqli_fetch_array($result)){?>

                                                <div class="col pd_5 md-width_50">
                                                    <div class="position-relative height_100">
                                                        <div  data-bs-toggle="modal"
                                                        data-bs-target="#myModal3" >
                                                            <img src="../images/<?php echo $row['url'] ?>"
                                                                class="rounded-3 height_100" alt=""  style="height: 250px;" data-bs-target="#carouselExampleCaptions3"
                                                        data-bs-slide-to="<?php echo $row['rank_ab'] - 1; ?>" aria-current="true" aria-label="Slide <?php echo $row['rank_ab']; ?>">
                                                        </div>
                                                       
                                                        <div
                                                            class=" d-flex align-items-center position-absolute top-0 end-0 rounded-circle pd_5 button_edit mg_5">
                                                            <div class="dropdown" style="height: 24px;">
                                                                <div class=" dropdown-toggle button_dr_afet" type="button"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">

                                                                    <span class="material-icons ">
                                                                        mode
                                                                    </span>

                                                                </div>


                                                                <ul class="dropdown-menu z_index_10">
                                                                    <li>
                                                                        <button
                                                                            class="btn d-flex align-items-center fz_12 justify-content-between">
                                                                            <span class="material-icons fz_12 text-black-50">
                                                                                send
                                                                            </span>
                                                                            <b> <span class="fz_12"> Chia sẻ ảnh</span></b>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button
                                                                            class="btn d-flex align-items-center  justify-content-between delete_jqa delete_anh3" id="<?php echo $row['postid'] ?>">
                                                                            <span class="material-icons fz_12 text-black-50">
                                                                                delete
                                                                            </span>
                                                                            <b><span class="fz_12"> Xóa ảnh</span></b>
                                                                        </button>
                                                                    </li>



                                                                </ul>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                    <?php  }  ?>

                                    <script>
     $(document).on('click', '.delete_anh3', function() {
            
            var inputs =$(this);
            for (var i = 0; i < inputs.length; i++) {
            
            var id_vao = inputs[i].id
            }
            $clicked_btn = $(this);
            $.ajax({
                url: '../process/delete_gioi_thieu.php',
                type: 'GET',
                data: {
                    'delete_anh3': 1,
                    'id': id_vao,
                },
                success: function(response) {
                    $clicked_btn.parent().parent().parent().parent().parent().parent().remove(); 
                }
            });
            
            
        });
 </script>