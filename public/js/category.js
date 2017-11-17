$(document).ready(function() {
	$('.delete_mod').click(function(){
		var id = $(this).attr('data-id');
		$('#category_form').attr('action', '/categories/' + id);
	});
});