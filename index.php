<?php

	ini_set('display_errors',1);
    error_reporting(E_ALL);

	require_once('admin/phpscripts/init.php');

	if(isset($_GET['filter'])) {
		$tbl1 = "tbl_movies";
		$tbl2 = "tbl_cat";
		$tbl3 = "tbl_l_mc";
		$col1 = "movies_id";
		$col2 = "cat_id";
		$col3 = "cat_name";
		$filter = $_GET['filter'];
		$getMovies = filterType($tbl1, $tbl2, $tbl3, $col1, $col2, $col3, $filter);
	}else{
		$tbl = "tbl_movies";
		$getMovies = getAll($tbl);
	}

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
<title>Movie Review Site</title>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- Custom Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7cOpen+Sans+Condensed:300%7cRaleway" rel="stylesheet" type="text/css">
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
//include('includes/nav.php');
?>

	<h1 class="text-center">Choose A Category:</h1>

	<section class="row" id="categoryCon">
		<div class="col-md-12">
			<ul class="list-unstyled" id="categories">
				<li><a id="1" class="movieType" href="index.php?filter=action">Action</a></li>
				<li><a id="2" class="movieType" href="index.php?filter=comedy">Comedy</a></li>
				<li><a id="3" class="movieType" href="index.php?filter=family">Family</a></li>
				<li><a  id="4" class="movieType" href="index.php?filter=horror">Horror</a></li>
				<li><a id="5" href="index.php">All</a></li>
			</ul>
		</div>
	</section>

	<div id="main" class="text-center">
		<div id="content">
			<p>Or search our database for your favourite movie:</p>
				<input type="search" name="keyword" placeholder="Search Movies" id="searchbox">
				<div id="results"></div>
		</div>
	</div>


<div class="container text-center">

	<section class="row" id="vidCon">
		<div class="col-md-12">
			<h2>Featured Trailer:</h2>
			<video controls id="mainVideo">
				<source src="images/trailers/meatballs.mp4" type="video/mp4">
					Your browser does not support Video. Please consider using Chrome or Firefox.
			</video>
		</div>
	</section>


	<section class="row" id="postComment">
		<div class="col-md-12 text-center">
			<h3>Already watched these movies?</h3>
		<?php
			ini_set('display_errors',1);
		    error_reporting(E_ALL);

			include 'admin/phpscripts/connect2.php';

		if ($_POST)
		{
		    $sid = mysqli_real_escape_string($link,$_POST['sid']);
		    $comment = mysqli_real_escape_string($link,$_POST['comment']);
		    $strSQL_Result  = mysqli_query($link,"INSERT INTO tbl_comments VALUES(NULL,'{$sid}','{$comment}',NULL)");
				exit;

		}
		$strSQL_Result  = mysqli_query($link,"SELECT id,status from tbl_status LIMIT 1");
		$row            = mysqli_fetch_array($strSQL_Result);
			//echo json_encode($row);
		$sid         = $row['id'];
		$status     = $row['status'];
		$commentshow = "";
		$strSQL_Comment     = mysqli_query($link,"SELECT id,comment,date_post from tbl_comments LIMIT 10");
		while($rowcomm = mysqli_fetch_array($strSQL_Comment))
		{
		    $id             = $rowcomm['id'];
		    $comment        = $rowcomm['comment'];
				 $date        = $rowcomm['date_post'];
		    $commentshow    .= "<div class='commentarea'>".$comment."<br>".$date."</div>";
		}
		?>

		<?php
		//add in name and time
				 echo "<div class=\"status text-center col-md-12\">$status</div><br>";
						echo "<div id=\"commentbox\">";
						echo "$commentshow";
						echo "</div>";
						echo "<input type=\"hidden\" name=\"sid\" id=\"sid\" value=\"$sid\">";
						echo "<input type=\"hidden\" name=\"date\" id=\"date\" value=\"$date\">";
						echo "<input type=\"text\" name=\"comment\" id=\"comment\" placeholder=\"Write a comment....\" />";
						//echo "<input class=\"btn btn-primary\" type=\"submit\" name=\"submit\" value=\"Post\">";
		 ?>
	 </div>
 </section>





<section class="row text-center">
<div class="col-md-12 text-center" id="bodyCon">
	<h2>Click a movie to watch the trailer!</h2><br>
<?php

	if(!is_string($getMovies)){
		while($row = mysqli_fetch_array($getMovies)){
			echo "<div id=\"moviesCon\">
			<a href=\"#\"><img src=\"images/{$row['movies_thumb']}\" alt=\"{$row['movies_title']}\" id=\"{$row['movies_id']}\"></a>
				 <h2>{$row['movies_title']}</h2>
				 <p>{$row['movies_year']}</p><br>
				 </div>";
		}
	}else{
		echo "<p>{$getMovies}</p>";
	}

?>
</div>
</section>

</div>


<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
function saveToDatabase(comment)
    {
        var select = comment;
        select = $(this).serialize();
        $('#comment').live("commentarea", function ()
        {
            // POST to database
            $.ajax
            ({
                type: 'POST',
                url: 'index.php',
                data:{comment:comment}
            }).then(function(data){alert(data)});
        });
    }

$(document).ready(function() {
$('#comment').keyup(function(e)
    {
        if(e.keyCode == 13)
        {
        var comment = $('#comment').val()
				var date = $('#date').val()
        var sid = $('#sid').val()
            if(comment == "")
            {
                alert("Please write something in comment.");
            }
            else
            {
                $("#commentbox").append("<div class=\'commentarea\'>"+comment+"<br>"+date+"</div>");
                $.post("index.php", {sid:sid,comment:comment,date:date},function(data)
                {
                })
                $('#comment').val("");
            }
        }
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#searchbox").on('keyup',function () {
            var key = $(this).val();

            $.ajax({
                url:'admin/searchQuery.php',
                type:'GET',
                data:'keyword='+key,
                beforeSend:function () {
                    $("#results").slideUp('fast');
                },
                success:function (data) {
                    $("#results").html(data);
                    $("#results").slideDown('fast');
                }
            });
        });
    });
</script>
<script src="js/main.js"></script>
</body>
</html>
