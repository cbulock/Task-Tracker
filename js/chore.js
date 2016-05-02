$('#record_chore').on('submit', function(event){
	event.preventDefault();
	TT.call('Chore/record', {
		id: $('#chore_id').val()
	})
	.done(function( response ) {
		TT.notifications.store( response.notification_message );
		location.href = '/';
	});
});