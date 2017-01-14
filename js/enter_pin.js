$('#enter_pin').on('submit', function(event){
	event.preventDefault();
	TT.call('User/set', {
		id: $('#id').val(),
		pin: $('#pin').val()
	})
	.done(function( response ) {
		TT.notifications.store( response.notification_message );
		location.href = '/';
	});
});