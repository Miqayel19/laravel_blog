$(document).ready(function() {
	$('.post_mod').click(function(){
		var id = $(this).attr('data-id');
		$('#post_form').attr('action', '/posts/' + id);
	});
});