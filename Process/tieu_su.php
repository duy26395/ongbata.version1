<?php  
 $connect = mysqli_connect("localhost", "root", "", "ongbata_v1");  
 if(!empty($_POST))  
 {  
      $ra_2 = '';  
      $message = '';  
      $nhap_mta_tieu_su= mysqli_real_escape_string($connect, $_POST["nhap_mta_tieu_su"]);
      $chi_tiet_tieu_su= mysqli_real_escape_string($connect, $_POST["chi_tiet_tieu_su"]);
      $userid= mysqli_real_escape_string($connect, $_POST["userid"]);          
      if($_POST["tieu_su_id"] != ' ')  
      {  
           $query = "  UPDATE tieu_su  SET 	mo_ta ='$nhap_mta_tieu_su',	noidung_ts='$chi_tiet_tieu_su'  WHERE id ='".$_POST["tieu_su_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  INSERT INTO tieu_su (	mo_ta, noidung_ts, membersid )  VALUES('{$nhap_mta_tieu_su}','{$chi_tiet_tieu_su}','{$userid}')  ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $ra_2 .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM tieu_su where membersid = '{$userid}' ORDER BY id DESC ";  
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
                                        <i class=" fa kiem_tra '. $row ['mo_ta'].' " style=" font-size: 28px;color: #20c997;"></i>
                        </div>

                        <div class="">
                            <div>
                                <span>'. $row ['noidung_ts'].'</span>
                            </div>
                            <span class="fz_12 text-black-50">'. $row ['mo_ta'].'</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class=" dropdown-toggle button_dr_afet" type="button"
                            data-bs-toggle="dropdown" aria-expanded="true">

                            <span class="material-icons text-black-50 cursor_p">
                                pending
                            </span>
                        </div>
                        <ul class="dropdown-menu  z_index_0">
                            <li>
                                <button id="'. $row ['id'].'"
                                    class="btn d-flex align-items-center fz_12 justify-content-between edit_data_5 "
                                    data-bs-toggle="modal" data-bs-target="#them_tieu_su">
                                    <span class="material-icons fz_12 text-black-50">
                                        drive_file_rename_outline
                                    </span>
                                    <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                </button>
                            </li>
                            <li>
                                <button data-id="'. $row ['id'].'"
                                    class=" delete_5 btn d-flex align-items-center  justify-content-between delete_jq">
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