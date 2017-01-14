$('.who').click(function(event){
	var id = $(this).val();
	event.preventDefault();
	TT.call('User/set', {
		id: id
	})
	.fail(function( response ) {
		location.href = '/enter_pin?user=' + id;
	})
	.done(function( response ) {
		TT.notifications.store( response.notification_message );
		location.href = '/';
	});
});