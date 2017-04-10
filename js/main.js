(function() {
	"use strict";

var catCon = document.querySelector("#categoryCon");
var cats = document.querySelectorAll('#categoryCon li');
var currentCat = 1;

//console.log(thumbnails.length);

$('#catCon li').on('click', function() {
		currentCat = this.id;

	$.getJSON('js/ajaxQuery.php', {movies_id : currentCat}, function(data) {
		console.log(data);

		$('#mainVideo').attr('src',"images/trailers/" + data.movies_trailer);
		$('#catCon div').addClass('nonActive');
		$('#'+data.movies_id).parent().removeClass('nonActive');

	});
});

})();
