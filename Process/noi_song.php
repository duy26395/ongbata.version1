<!-- noi song -->
<?php  
 $connect = mysqli_connect("localhost", "root", "", "ongbata_v1");  
 if(!empty($_POST))  
 {  
      $ra_2 = '';  
      $message = '';  
      $nhap_noi_ns= mysqli_real_escape_string($connect, $_POST["nhap_noi_song"]);
      $mo_ta= mysqli_real_escape_string($connect, $_POST["mo_ta"]);   
      $userid= mysqli_real_escape_string($connect, $_POST["userid"]);     
      if($_POST["noi_song_id"] != ' ')  
      {  
           $query = "  UPDATE noi_song  SET noi_song='$nhap_noi_ns',mo_ta='$mo_ta'  WHERE id ='".$_POST["noi_song_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  INSERT INTO noi_song (noi_song,mo_ta, membersid)  VALUES('{$nhap_noi_ns}','{$mo_ta}','{$userid}')  ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $ra_2 .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM noi_song where membersid = '{$userid}' ORDER BY id DESC ";  
           $result = mysqli_query($connect, $select_query);  
        //    $output .= '  
        //         <div class="">  
                   
        //    ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $ra_2 .= '  
                    
                <div class="d-flex justify-content-between align-items-center">

                    <div class="d-flex justify-content-between align-items-center"  id="xoa_2">

                        <div class="">
                            <i class="fas '. $row ['mo_ta'].' "></i>
                        </div>

                        <div class="">
                            <div><a href="" class="text_black">'.$row ['noi_song'] .'</a>
                            </div>
                            <span class="fz_12 text-black-50">'. $row ['mo_ta'].'</span>

                        </div>
                    </div>
                    <div class="d-flex align-items-center ">
                        <div class=" dropdown-toggle button_dr_afet" type="button"
                            data-bs-toggle="dropdown" aria-expanded="true">

                            <span class="material-icons text-black-50 cursor_p">
                                pending
                            </span>
                        </div>
                        <ul class="dropdown-menu  z_index_0">
                            <li>
                                <button
                                    class="btn d-flex align-items-center fz_12 justify-content-between edit_data_2 " id="'. $row["id"].'"
                                    data-bs-toggle="modal" data-bs-target="#them_noi_song" name="edit_2">
                                    <span class="material-icons fz_12 text-black-50">
                                        drive_file_rename_outline
                                    </span>
                                    <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                </button>
                            </li>
                            <li>
                                <button
                                    class=" delete_2 btn d-flex align-items-center  justify-content-between delete_jq" data-id='.$row ['id'].'> 
                                    <span class="material-icons fz_12 text-black-50">
                                        delete
                                    </span>
                                    <b><span class="fz_12"> Xóa sự kiện</span></b>
                                </button>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                ';  
           }  
        //    $output .= '</div>';  
      }  
      echo $ra_2;  
 }  



?>
<script>
    $(".delete_jq").click(function(){
                $(this).parent().parent().parent().parent().remove();
                });
</script>