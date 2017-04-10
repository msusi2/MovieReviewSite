(function() {
	"use strict";

var catCon = document.querySelector("#categoryCon");
var cats = document.querySelectorAll('#categories li a');
var currentCat = 1;

console.log('working');
console.log(cats.length);

$('#categories li a').on('click', function() {
		currentCat = this.id;
    console.log(this.id)


	$.getJSON('phpscripts/ajaxQuery.php', {movies_id : cats}, function(data) {
		console.log(data);
    console.log('function working');

		$('#mainVideo').attr('src',"images/trailers/" + data.movies_trailer);
		$('#categories li a').addClass('nonActive');
		$('#'+data.movies_id).parent().removeClass('nonActive');

	});
});

})();
