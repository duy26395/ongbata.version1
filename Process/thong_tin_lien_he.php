<?php  
 $connect = mysqli_connect("localhost", "root", "", "ongbata_v1");  
 if(!empty($_POST))  
 {  
      $ra_2 = '';  
      $message = '';  
      $nhap_lien_he= mysqli_real_escape_string($connect, $_POST["nhap_lien_he"]);
      $loai_lien_he= mysqli_real_escape_string($connect, $_POST["loai_lienhe"]);  
      $userid= mysqli_real_escape_string($connect, $_POST["userid"]);        
      if($_POST["lien_he_id"] != ' ')  
      {  
           $query = "  UPDATE thong_tin_lien_he  SET thong_tin_lien_he='$nhap_lien_he',loai_lien_he='$loai_lien_he'  WHERE id ='".$_POST["lien_he_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  INSERT INTO thong_tin_lien_he (thong_tin_lien_he,	loai_lien_he,membersid )  VALUES('{$nhap_lien_he}','{$loai_lien_he},'{$userid}')  ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $ra_2 .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM thong_tin_lien_he where membersid = '{$userid}' ORDER BY id DESC ";  
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
                            <i class="'. $row ['loai_lien_he'].' " style=" font-size: 28px;color: #20c997;"></i>
                        </div>

                        <div class="">
                            <div><a href="" class="text_black">
                                   '.$row ['thong_tin_lien_he'].'

                                </a>
                            </div>
                            <span class="fz_12 text-black-50">'. $row ['loai_lien_he'].'</span>

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
                                    class="btn d-flex align-items-center fz_12 justify-content-between edit_data_3 "
                                    data-bs-toggle="modal" data-bs-target="#them_thong_tin_lien_he" name="edit_3" id="'. $row ['id'].'">
                                    <span class="material-icons fz_12 text-black-50">
                                        drive_file_rename_outline
                                    </span>
                                    <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                </button>
                            </li>
                            <li>
                                <button
                                    class=" delete_3 btn d-flex align-items-center  justify-content-between delete_jq" data-id='. $row['id'].'>
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