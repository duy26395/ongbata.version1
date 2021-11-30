<?php 
$connect = mysqli_connect("localhost", "root", "", "ongbata_v1");  
if(!empty($_POST))  
{ 
    $loaction = mysqli_real_escape_string($connect, $_POST["loaction"]);
    $userid = mysqli_real_escape_string($connect, $_POST["userid"]); 
    $ten_mo =  mysqli_real_escape_string($connect, $_POST["nhap_ten-diadiem"]);
    $chi_tiet_mo = mysqli_real_escape_string($connect, $_POST["nhap_mota-diadiem"]);
    $query = "INSERT INTO mapbox (location ,title,paragraph, membersid )  VALUES('{$loaction}','{$ten_mo}','{$chi_tiet_mo}','{$userid}')  ";  
    mysqli_query($connect, $query);    
}


?>
 