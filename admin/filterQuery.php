<?php
	include 'phpscripts/connect.php';

	$link->set_charset("utf8");

$movieCat = $_GET["cat_id"];

$catQuery = "SELECT * FROM tbl_l_mc WHERE cat_id = '$movieCat'";
$result2 = mysqli_query($link, $catQuery);
$row2 = mysqli_fetch_assoc($result2);

echo json_encode($row2);
?>
