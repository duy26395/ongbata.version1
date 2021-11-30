<?php  
 $connect = mysqli_connect("localhost", "root", "", "ongbata_v1");  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $nhap_noi_lv= mysqli_real_escape_string($connect, $_POST["nhap_noi_lv"]);
      $userid= mysqli_real_escape_string($connect, $_POST["userid"]);   
      if($_POST["cong_viec_id"] !=' ')  
      {  
           $query = "  UPDATE cong_viec  SET noi_lam_viec='$nhap_noi_lv'  WHERE id ='".$_POST["cong_viec_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  INSERT INTO cong_viec (noi_lam_viec,membersid)  VALUES('{$nhap_noi_lv}','{$userid}') ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM cong_viec where membersid = '{$userid}' ORDER BY id DESC ";  
           $result = mysqli_query($connect, $select_query);  
        //    $output .= '  
        //         <div class="">  
                   
        //    ';  
            
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                    
                     <div class="  d-flex justify-content-between align-items-center">

                                                                <div class="d-flex justify-content-between align-items-center" id='.$row['id'].'">
                                                               
                                                                    <div class="avatar-sm ">
                                                                        <i class="fas   '. $row ['noi_lam_viec'].'"> </i>
                                                                    </div>

                                                                    <div class="">
                                                                        <div> 
                                                                            '.$row ['noi_lam_viec'].'
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <div class=" dropdown-toggle button_dr_afet" type="button"
                                                                        data-bs-toggle="dropdown" aria-expanded="true">

                                                                        <span class="material-icons text-black-50 cursor_p">
                                                                            edit
                                                                        </span>
                                                                    </div>
                                                                    <ul class="dropdown-menu  z_index_0">
                                                                            <li>
                                                                            
                                                                                <button
                                                                                    class="btn d-flex align-items-center fz_12 justify-content-between edit_data "
                                                                                    name="edit"  id="'.$row['id'].'"  >
                                                                                    <span class="material-icons fz_12 text-black-50">
                                                                                        drive_file_rename_outline
                                                                                    </span>
                                                                                    <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button
                                                                                    class="delete btn d-flex align-items-center  justify-content-between delete_jq" data-id="'.$row['id'].'">
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
      echo $output;  
 }



?>
<script>
    $(".delete_jq").click(function(){
                $(this).parent().parent().parent().parent().remove();
                });
</script>