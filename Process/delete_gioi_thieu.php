<?php
 $conn = mysqli_connect('localhost', 'root', '', 'ongbata_v1');
  define('CSSPATH', 'template/css/'); //define css path
  $cssItem = 'profile-ongbata.css'; //css item to display

?>

<!-- gioi thieu -->
<?php 
  
  // delete comment fromd database
  if (isset($_GET['delete'])) {
  	$id = $_GET['id'];
  	$sql = "DELETE FROM cong_viec WHERE id =" . $id;
  	mysqli_query($conn, $sql);
  	exit();
  }
  // delete comment fromd database
  if (isset($_GET['delete_2'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM noi_song WHERE id =" . $id;
	mysqli_query($conn, $sql);
	exit();
	}
	// delete comment fromd database
	
	if (isset($_GET['delete_3'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM thong_tin_lien_he WHERE id =" . $id;
		mysqli_query($conn, $sql);
		exit();
		}
	if (isset($_GET['delete_4'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM thong_tin_co_ban WHERE id =" . $id;
		mysqli_query($conn, $sql);
		exit();
		}
	if (isset($_GET['delete_5'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM tieu_su WHERE id =" . $id;
		mysqli_query($conn, $sql);
		exit();
		}
	if (isset($_GET['delete_6'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM su_kien_trong_doi WHERE id =" . $id;
		mysqli_query($conn, $sql);
		exit();
		}
?>
<!-- anh-->
<?php 
  
  // delete comment fromd database
  if (isset($_GET['delete_anh1'])) {
  	$id = $_GET['id'];
  	$sql = "DELETE FROM gallery WHERE ID =" . $id;
  	mysqli_query($conn, $sql);
  	exit();
  }
   // delete comment fromd database
   if (isset($_GET['delete_anh2'])) {
	$id = $_GET['id'];
	// $sql = "DELETE FROM gallery WHERE ID =" . $id;
	$sql ="DELETE gallery,post,postaction FROM gallery LEFT JOIN postaction ON gallery.postid=postaction.postid
  LEFT JOIN post ON postaction.postid=post.id WHERE gallery.postid IN (". $id.")";
	mysqli_query($conn, $sql);
	exit();
	}
	// delete comment fromd database
	if (isset($_GET['delete_anh3'])) {
		$id = $_GET['id'];
		$sql ="DELETE gallery,post,postaction FROM gallery LEFT JOIN postaction ON gallery.postid=postaction.postid
		LEFT JOIN post ON postaction.postid=post.id WHERE gallery.postid IN (". $id.")";
		mysqli_query($conn, $sql);
		exit();
	}
	// delete comment fromd database
	if (isset($_GET['delete_video'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM gallery WHERE ID =" . $id;
		mysqli_query($conn, $sql);
		exit();
	}

?>