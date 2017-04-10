(function() {
	"use strict";

//var catCon = document.querySelector("#categoryCon");
//var cats = document.querySelectorAll('#categories li a');
var currentVid = 1;

//console.log('working');
//console.log(cats.length);

$('#moviesCon img').on('click', function() {
		currentVid = this.id;
   console.log(this.id);

$.getJSON('admin/ajaxQuery.php', {movies_id : currentVid}, function(data) {
	console.log(data);
	//$('#mainVideo').attr('src', "images/trailers/" + data.movies_trailer);
});

});

})();
