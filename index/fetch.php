<?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "ongbata_v1");  
 if(isset($_POST["cong_viec_id"]))  
 {  
      $query = "SELECT * FROM cong_viec WHERE id = '".$_POST["cong_viec_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }


     //noi song
     if(isset($_POST["noi_song_id"]))  
 {  
      $query = "SELECT * FROM noi_song WHERE id = '".$_POST["noi_song_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 } 

   //lien he
   if(isset($_POST["lien_he_id"]))  
   {  
        $query = "SELECT * FROM thong_tin_lien_he WHERE id = '".$_POST["lien_he_id"]."'";  
        $result = mysqli_query($connect, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);  
   } 

    //thong tin co ban
    if(isset($_POST["co_ban_id"]))  
    {  
         $query = "SELECT * FROM thong_tin_co_ban WHERE id = '".$_POST["co_ban_id"]."'";  
         $result = mysqli_query($connect, $query);  
         $row = mysqli_fetch_array($result);  
         echo json_encode($row);  
    } 
    //tieu su
    if(isset($_POST["tieu_su_id"]))  
    {  
         $query = "SELECT * FROM tieu_su WHERE id = '".$_POST["tieu_su_id"]."'";  
         $result = mysqli_query($connect, $query);  
         $row = mysqli_fetch_array($result);  
         echo json_encode($row);  
    } 

    //su kien
    if(isset($_POST["su_kien_id"]))  
    {  
         $query = "SELECT * FROM su_kien_trong_doi WHERE id = '".$_POST["su_kien_id"]."'";  
         $result = mysqli_query($connect, $query);  
         $row = mysqli_fetch_array($result);  
         echo json_encode($row);  
    } 
?>
