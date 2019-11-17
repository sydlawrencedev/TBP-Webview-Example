$(function() {
	$('[type="submit"]').on('click', function () {
	    // this adds 'required' class to all the required inputs under the same <form> as the submit button
	    $(this)
	        .closest('form')
	        .find('[required]')
	        .addClass('required');
	});

	
})
