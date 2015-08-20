$(document).ready(function() {
	$("#shishyawali").click(function() {
		if($(".slist").hasClass('hidden')) {
			$(".slist").removeClass('hidden');
		} else {
			$(".slist").addClass('hidden');
		}
	});
});
