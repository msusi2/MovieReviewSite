$(document).foundation();
(function() {
	"use strict";

var thumbCon = document.querySelector("#thumbCon");
var thumbs = document.querySelectorAll('#thumbCon img');
var currentVideo = 1;

//console.log(thumbnails.length);

$('#thumbCon img').on('click', function() {
		currentVideo = this.id;

	$.getJSON('js/ajaxQuery.php', {movies_id : currentVideo}, function(data) {
		//console.log(data);

		$('#mainVideo img').attr('src',"images/uploads/" + data.gallery_img);
		$('#thumbnailCon div').addClass('nonActive');
		$('#'+data.gallery_id).parent().removeClass('nonActive');

	});
});

})();
