$(document).ready(function(){
	$("#list-parent li").on("click", function() {
		var cible = $(this).find('a').attr("href");
		$("html, body").animate({scrollTop: $(cible).offset().top}, 750);
		return false;
	})
});
