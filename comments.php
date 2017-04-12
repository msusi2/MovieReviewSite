<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
<title>Comments</title>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- Custom Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7cOpen+Sans+Condensed:300%7cRaleway" rel="stylesheet" type="text/css">
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
<br>

<?php
	ini_set('display_errors',1);
    error_reporting(E_ALL);

	include 'admin/phpscripts/connect2.php';

	if($_POST)
{
    $sid = mysqli_real_escape_string($link,$_POST['sid']);
    $comment = mysqli_real_escape_string($link,$_POST['comment']);

    $strSQL_Result  = "INSERT into tbl_comments(sid,comment) values(NULL,'$sid','$comment',CURRENT_TIMESTAMP)";
		exit;

}
$strSQL_Result  = mysqli_query($link,"SELECT id,status from tbl_status LIMIT 1");
$row            = mysqli_fetch_array($strSQL_Result);
	//echo json_encode($row);
$sid         = $row['id'];
$status     = $row['status'];
$commentshow = "";
$strSQL_Comment     = mysqli_query($link,"SELECT id,comment from tbl_comments LIMIT 3");
while($rowcomm = mysqli_fetch_array($strSQL_Comment))
{
    $id             = $rowcomm['id'];
    $comment        = $rowcomm['comment'];
    $commentshow    .= "<div class='commentarea'>".$comment."</div>";
}
?>

<?php
//echo "<script type=\"text/javascript\" src=\"jquery-1.8.0.min.js\"></script>";
			echo "<div class=\"status\">$status</div>";
				echo "<div id=\"commentbox\">";
				echo "$commentshow";
				echo "</div>";
				echo "<input type=\"hidden\" name=\"sid\" id=\"sid\" value=\"$sid\">";
				echo "<input type=\"text\" name=\"comment\" id=\"comment\" placeholder=\"Write a comment....\" />";
				//echo "<input class=\"btn btn-primary\" type=\"submit\" name=\"submit\" value=\"Post\">";
 ?>



<!-- jQuery -->
<script type="text/javascript" src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#comment').keyup(function(e)
    {
        if(e.keyCode == 13)
        {
        var comment = $('#comment').val()
        var sid = $('#sid').val()
            if(comment == "")
            {
                alert("Please write something in comment.");
            }
            else
            {
                $("#commentbox").append("<div class=\'commentarea\'>"+comment+"</div>");
                $.post("comments.php", {sid:sid,comment:comment},function(data)
                {
                })
                $('#comment').val("");
            }
        }
    });
});
</script>
<script type="text/javascript" src="js/comments.js"></script>
</body>
</html>
