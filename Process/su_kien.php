<?php  
 $connect = mysqli_connect("localhost", "root", "", "ongbata_v1");  
 if(!empty($_POST))  
 {  
      $ra_2 = '';  
      $message = '';  
      $nhap_thoi_gian= mysqli_real_escape_string($connect, $_POST["nhap_thoi_gian"]);
      $nhap_sk= mysqli_real_escape_string($connect, $_POST["nhap_sk"]);  
      $chi_tiet_su_kien= mysqli_real_escape_string($connect, $_POST["chi_tiet_su_kien"]);
      $userid= mysqli_real_escape_string($connect, $_POST["userid"]);   
         
      if($_POST["su_kien_id"] != ' ')  
      {  
           $query = "  UPDATE su_kien_trong_doi  SET 	thoi_gian ='$nhap_thoi_gian',su_kien='$nhap_sk',		chi_tiet_su_kien='$chi_tiet_su_kien'  WHERE id ='".$_POST["su_kien_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  INSERT INTO su_kien_trong_doi (thoi_gian,su_kien, 	chi_tiet_su_kien,membersid )  VALUES('{$nhap_thoi_gian}','{$nhap_sk}','{$chi_tiet_su_kien}','{$userid}')  ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $ra_2 .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM su_kien_trong_doi where membersid = '{$userid}' ORDER BY id DESC ";  
           $result = mysqli_query($connect, $select_query);  
        //    $output .= '  
        //         <div class="">  
                   
        //    ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $ra_2 .= '  
                <div class="d-grid">
                    <h3 class="fz_17"><b><span>'. $row ['thoi_gian'].'</span></b></h3>
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex justify-content-between align-items-start">

                            <div class="avatar-sm ">
                                <img src="../images/729130-200.png"
                                    alt="" class="rounded-circle">
                            </div>

                            <div class="">
                                <div>
                                        '. $row ['su_kien'].'
                                </div>

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
                                    <button id="'.$row ['id'].'"
                                        class="btn d-flex align-items-center fz_12 justify-content-between edit_data_6 "
                                        data-bs-toggle="modal" data-bs-target="#them_su_kien">
                                        <span class="material-icons fz_12 text-black-50">
                                            drive_file_rename_outline
                                        </span>
                                        <b> <span class="fz_12"> Chỉnh sửa sự kiện </span></b>
                                    </button>
                                </li>
                                <li>
                                    <button data-id="'. $row ['id'].'"
                                        class="delete_6 btn d-flex align-items-center  justify-content-between delete_jq">
                                        <span class="material-icons fz_12 text-black-50">
                                            delete
                                        </span>
                                        <b><span class="fz_12"> Xóa sự kiện</span></b>
                                    </button>
                                </li>



                            </ul>
                        </div>
                    </div>
                    <p>
                        <span>
                           '. $row ['chi_tiet_su_kien'].'
                        </span>
                    </p>
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