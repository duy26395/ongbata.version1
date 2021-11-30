<?php  
 $connect = mysqli_connect("localhost", "root", "", "ongbata_v1");  
 if(!empty($_POST))  
 {  
      $ra_2 = '';  
      $message = '';  
      $nhap_thong_tin_coban= mysqli_real_escape_string($connect, $_POST["nhap_thong_tin_cb"]);
      $chon_loai_thongtin= mysqli_real_escape_string($connect, $_POST["chon_loai_tt"]); 
      $userid= mysqli_real_escape_string($connect, $_POST["userid"]);       
      if($_POST["co_ban_id"] != ' ')  
      {  
           $query = "  UPDATE thong_tin_co_ban  SET thong_tin_co_ban='$nhap_thong_tin_coban',loai_thong_tin='$chon_loai_thongtin'  WHERE id ='".$_POST["co_ban_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  INSERT INTO thong_tin_co_ban (thong_tin_co_ban,	loai_thong_tin,membersid )  VALUES('{$nhap_thong_tin_coban}','{$chon_loai_thongtin}','{$userid}')  ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $ra_2 .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM thong_tin_co_ban where membersid = '{$userid}' ORDER BY id DESC ";  
           $result = mysqli_query($connect, $select_query);  
        //    $output .= '  
        //         <div class="">  
                   
        //    ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $ra_2 .= '  
                    
                                                         <div class="d-flex justify-content-between align-items-center">

                                                                <div class="d-flex justify-content-between align-items-start">

                                                                    <div class="" style="margin-right: 5px;">
                                                                            <i class=" fa kiem_tra '.$row ['loai_thong_tin'].'" style=" font-size: 28px;color: #20c997;"></i>
                                                                    </div>

                                                                    <div class="">
                                                                        <div>
                                                                            <span class="kiem_tra">  '.$row ['thong_tin_co_ban'].'</span>


                                                                        </div>
                                                                        <span class="fz_12 text-black-50"> '. $row ['loai_thong_tin'].'</span>

                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <div class=" dropdown-toggle button_dr_afet" type="button"
                                                                        data-bs-toggle="dropdown" aria-expanded="true">

                                                                        <span class="material-icons text-black-50 cursor_p">
                                                                            drive_file_rename_outline
                                                                        </span>
                                                                    </div>
                                                                    <ul class="dropdown-menu  z_index_0">
                                                                        <li>
                                                                            <button
                                                                                class="btn d-flex align-items-center fz_12 justify-content-between edit_data_4 "
                                                                                data-bs-toggle="modal" data-bs-target="#them_thong_tin_co_ban" id="'. $row ['id'].'">
                                                                                <span class="material-icons fz_12 text-black-50">
                                                                                    drive_file_rename_outline
                                                                                </span>
                                                                                <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                                            </button>
                                                                        </li>
                                                                        <li>
                                                                            <button
                                                                                class="delete_4 btn d-flex align-items-center  justify-content-between delete_jq">
                                                                                <span class="material-icons fz_12 text-black-50" data-id='. $row ['id'].'>>
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