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
<!-- Custom Fonts & Styles-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7cOpen+Sans+Condensed:300%7cRaleway" rel="stylesheet" type="text/css">
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
//include('includes/nav.php');
?>

	<section class="container" id="logoCon">
		<img src="images/logo.svg" class="img-responsive logo">
	</section>

	<h1 class="text-center">Choose A Category:</h1>

	<section class="row" id="categoryCon">
		<div class="col-xs-12 col-md-12">
			<ul class="list-unstyled" id="categories">
				<li><a id="1" class="movieType" href="index.php?filter=action">Action</a></li>
				<li><a id="2" class="movieType" href="index.php?filter=comedy">Comedy</a></li>
				<li><a id="3" class="movieType" href="index.php?filter=family">Family</a></li>
				<li><a  id="4" class="movieType" href="index.php?filter=horror">Horror</a></li>
				<li><a id="5" href="index.php">All</a></li>
			</ul>
		</div>
	</section>

	<div id="main" class="text-center col-xs-12 col-md-8 col-md-offset-2">
		<div id="content">
			<p class="searchInfo text-center">Or search our database for your favourite movie:</p>
				<input type="search" name="keyword" placeholder="Search Movies" id="searchbox">
				<div id="results"></div>
		</div>
	</div>

<section class="row text-center vidCon">
	<div class="container text-center">
		<h2 class="hidden"> Media Player </h2>
			<div id="mediaPlayer" class="col-xs-12 col-md-12">

				<video controls id="mainVideo">
					<source src="images/trailers/meatballs.mp4" type="video/mp4">
						Your browser does not support Video. Please consider using Chrome or Firefox.
				</video>

					<div id='mediaControls' class="col-xs-12 col-md-12">

					<progress id='progress-bar' max='100' value='0'>0% played</progress> <br>

	<button id='play-pause-button' class='play btn btn-custom' title='Play' onclick='togglePlayPause();'>Play</button>

	<button id='stop-button' class='stop btn btn-custom' title='Stop' onclick='stopPlayer();'>Stop</button>

	<button id='volume-inc-button' class='volume-plus btn btn-custom' title='Increase Volume' onclick='changeVolume("+");'>&Delta;</button>

	<button id='volume-dec-button' class='volume-minus btn btn-custom' title='Decrease Volume' onclick='changeVolume("-");'>&nabla;</button>

	<button id='mute-button' class='mute btn btn-custom' title='Mute' onclick='toggleMute();'>Mute</button>

	<button id='replay-button' class='replay btn btn-custom' title='Replay' onclick='replayMedia();'>Replay</button>

		</div> <!--end media controls-->


			</div><!--end media player-->
	</section>

	<!--<section class="row" id="vidCon">
		<div class="col-xs-12 col-md-12">
			<h2>Featured Trailer:</h2>
			<video controls id="mainVideo">
				<source src="images/trailers/meatballs.mp4" type="video/mp4">
					Your browser does not support Video. Please consider using Chrome or Firefox.
			</video>
		</div>
	</section> -->


	<section class="row text-center" id="postComment">
		<div class="col-xs-12 col-md-12 text-center">
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
				 echo "<span class=\"status\">$status</span><br>";
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
<div class="col-xs-4 col-md-4 text-center col-xs-offset-4 col-md-offset-4" id="bodyCon">
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
<script type="text/javascript">
var mediaPlayer = document.querySelector("video");
 var progressBar = document.querySelector('#progress-bar');
  var playPauseBtn = document.querySelector('#play-pause-button');
document.addEventListener("DOMContentLoaded", function() { initialiseMediaPlayer(); }, false);

function initialiseMediaPlayer() {      //hide default browser controls
	 var mediaPlayer = document.querySelector('#mainVideo');
	 mediaPlayer.controls = false;
}


// play and pause button //

function togglePlayPause() {
	 var btn = document.querySelector('#play-pause-button');

	 if (mediaPlayer.paused | mediaPlayer.ended) {    //when "play-pause-button" clicked,if the media player is paused or ended, make the button play the video
			btn.title = 'Pause';
			btn.innerHTML = 'Pause';
			btn.className = 'Pause';
			mediaPlayer.play();
	 }
	 else {                          //when clicked, if the media player is playing, pause it
			btn.title = 'Play';
			btn.innerHTML = 'Play';
			btn.className = 'Play';
			mediaPlayer.pause();
	 }
}


function changeButtonType(btn, value) {
	 btn.title = value;
	 btn.innerHTML = value;
	 btn.className = value;
}


// stop button //

function stopPlayer() {       //Stop-button will pause video and reset play-time to 0
	 mediaPlayer.pause();
	 mediaPlayer.currentTime = 0;
}

// change volume //
function changeVolume(direction) {
	 if (direction === '+') mediaPlayer.volume += mediaPlayer.volume == 1 ? 0 : 0.1;   //if the direction is +, make media player volume increase by .1
	 else mediaPlayer.volume -= (mediaPlayer.volume == 0 ? 0 : 0.1);   //or, if the direction is -, make media player volume decrease by .1
	 mediaPlayer.volume = parseFloat(mediaPlayer.volume).toFixed(1);
}

// mute and unmute sound //
function toggleMute() {
	 var btn = document.querySelector('#mute-button');       //player is not muted, button says "mute"
	 if (mediaPlayer.muted) {
			changeButtonType(btn, 'Mute');
			mediaPlayer.muted = false;
	 }
	 else {
			changeButtonType(btn, 'Unmute');    //player is muted, button says "unmute"
			mediaPlayer.muted = true;
	 }
}

// replay video //
function replayMedia() {         //reset media to beginning and play
		mediaPlayer.currentTime = 0;
	 resetPlayer();
	 mediaPlayer.play();
}

//make player time return to 0 //
function resetPlayer() {
	 mediaPlayer.currentTime = 0;
	 changeButtonType(playPauseBtn, 'Play');
}


// progress bar //

mediaPlayer.addEventListener('timeupdate', updateProgressBar, false);

function updateProgressBar() {
	 var progressBar = document.querySelector('#progress-bar');
	 var percentage = Math.floor((100 / mediaPlayer.duration) *
	 mediaPlayer.currentTime);
	 progressBar.value = percentage;
	 progressBar.innerHTML = percentage + '% played';
}

function resetPlayer() {    //when media is reset to 0, also make progress bar return to 0
	 progressBar.value = 0;
	 mediaPlayer.currentTime = 0;
	 changeButtonType(playPauseBtn, 'Play');
}





mediaPlayer.addEventListener('Play', function() {              // if video is playing, make sure the button says pause.
	 var btn = document.querySelector('#play-pause-button');
	 changeButtonType(btn, 'Pause');
}, false);

mediaPlayer.addEventListener('Pause', function() {              // If it is paused, make sure it says play //
	 var btn = document.querySelector('#play-pause-button');
	 changeButtonType(btn, 'Play');
}, false);



mediaPlayer.addEventListener('volumechange', function(e) {   //change volume for media player if A or B

	 var btn = document.querySelector('#mute-button');

	 if (mediaPlayer.muted) changeButtonType(btn, 'Unmute');  // A: if player is muted, have button say unmute //

	 else changeButtonType(btn, 'Mute');   //B: If volume is playing and greater than .1, have button say mute //
}, false);


</script>
<script src="js/main.js"></script>
</body>
</html>
