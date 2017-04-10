<?php

	ini_set('display_errors',1);
    error_reporting(E_ALL);

	require_once('phpscripts/init.php');

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
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7cOpen+Sans+Condensed:300%7cRaleway" rel="stylesheet" type="text/css">
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
include('includes/nav.php');
?>

	<h1 class="text-center">Choose A Category:</h1>

	<section class="row">
		<div class="col-md-12">
			<ul class="list-unstyled" id="categories">
				<li>Horror</li>
				<li>Comedy</li>
				<li>Family</li>
				<li>Action</li>
				<li>Drama</li>
			</ul>
		</div>
	</section>

<div class="container text-center">

	<section class="row" id="vidCon">
		<div class="col-md-12">
			<h2>Featured Video</h2>
			<video id="mainVideo"></video>
		</div>

		<div class="col-md-12">
			<h3>Post A Comment:</h3>
			<form action="index.php" method="post" id="commentBox">
				<div class="form-group">
				<label for="name">Name:</label>
						<input type="text" class="form-control text-center" id="name" name="poster_name" placeholder="Enter Your Name">
				</div>
				<div class="form-group">
				<label for="message">Comment:</label>
<textarea class="form-control text-center" id="message" name="poster_comment" placeholder="What did you think?" maxlength="140" rows="7"></textarea>
				</div>
			</form>
		</div>
	</section>



</div>

<?php


	//include('includes/nav.php');




	/*if(!is_string($getMovies)){
		while($row = mysqli_fetch_array($getMovies)){
			echo "<img src=\"images/{$row['movies_thumb']}\" alt=\"{$row['movies_title']}\">
				 <h2>{$row['movies_title']}</h2>
				 <p>{$row['movies_year']}</p><br>
				 <a href=\"details.php?id={$row['movies_id']}\">More...</a><br><br>";
		}
	}else{
		echo "<p>{$getMovies}</p>";
	} */

//<footer>
	//include('includes/footer.php');
	//</footer>

?>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
 <script src="js/main.js"></script>
</body>
</html>
