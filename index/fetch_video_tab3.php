<link rel="stylesheet" href="../css/thu_vien_video.css">
<link rel="stylesheet" href="../mediaelement-mediaelement-3b02c78/build/mediaelementplayer.css">
<?php
    require_once('dbConnection.php');
    $userid = '1';
                                    $query = "SELECT *, @rank :=  @rank + 1 AS rank_av FROM gallery g left join post p on p.ID = g.postid, (SELECT  @rank := 0) r where membersid = '{$userid}' and gallerycategoryid = '8' ORDER BY g.id DESC;";

                                            $result = mysqli_query($connect, $query);
                                                                                            
                                            while ($row = mysqli_fetch_array($result)){?>

                                                                                                
                                            <div class="col pd_5 md-width_50 video_tab3">
                                                        <div class="position-relative height_100">
                                                                                        
                                                                                                        <div class="media-wrapper">
                                                                                                                <video id="player1" style="max-width:100%; height: 200px;" class="video"
                                                                                                                    poster="https://media.istockphoto.com/videos/movie-time-concept-background-video-id1127766856?s=640x640"
                                                                                                                    preload="none" controls playsinline webkit-playsinline>
                                                                                                                    <source src="../images/<?php echo $row['url'] ?>" type="video/mp4">
                                                                                                                </video>
                                                                                                            
                                                                                                            
                                                                                                        </div>
                                                                                                        
                                                                                                        <div class=" d-flex align-items-center position-absolute top-0 end-0 rounded-circle pd_5 button_edit mg_5">
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
                                                                                                                            class=" delete_video btn d-flex align-items-center  justify-content-between delete_jqa " id="<?php echo $row['ID'] ?>">
                                                                                                                            <span class="material-icons fz_12 text-black-50">
                                                                                                                                delete
                                                                                                                            </span>
                                                                                                                            <b><span class="fz_12"> Xóa video</span></b>
                                                                                                                        </button>
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            </div>
                                                                                                        </div>
                                                    </div>
                                            </div>
                                        
 <?php  }  ?>
 <script src="../mediaelement-mediaelement-3b02c78/build/mediaelement-and-player.js"></script>
<script src="../javascript/thu_vien_video.js"></script>
