<?php

include 'phpscripts/connect.php';
	$link->set_charset("utf8");

$movieName = $_GET["movies_title"];
$keyword = mysqli_real_escape_string($link, $_REQUEST['movies_title']);

if(isset($keyword)){
    $sql = "SELECT * FROM tbl_movies WHERE movies_title LIKE '" . $keyword . "' ";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p>" . $row['movies_title'] . "</p>";
            }
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }
    } else{
        echo "An error occured. Please try again. " . mysqli_error($link);
    }
}

echo json_encode($row);
mysqli_close($link);
?>
