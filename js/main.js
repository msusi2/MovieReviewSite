(function() {
	"use strict";

var catCon = document.querySelector("#categoryCon");
var cats = document.querySelectorAll('#categoryCon li a');
var currentCat = 1;

console.log('working');
console.log(cats.length);

$('#categoryCon li a').on('click', function() {
		currentCat = this.id;
    console.log(this.id)


	$.getJSON('phpscripts/ajaxQuery.php', {movies_id : currentCat}, function(data) {
		console.log(data);
    console.log('function working');

		$('#mainVideo').attr('src',"images/trailers/" + data.movies_trailer);
		$('#categoryCon div').addClass('nonActive');
		$('#'+data.movies_id).parent().removeClass('nonActive');

	});
});

})();
