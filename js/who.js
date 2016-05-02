$('.who').click(function(event){
	event.preventDefault();
	TT.call('User/set', {
		id: $(this).val()
	})
	.done(function( response ) {
		TT.notifications.store( response.notification_message );
		location.href = '/';
	});
});