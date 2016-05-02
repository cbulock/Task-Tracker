$('#record_task').on('submit', function(event){
	event.preventDefault();
	TT.call('Task/record', {
		id: $('#task_id').val()
	})
	.done(function( response ) {
		TT.notifications.store( response.notification_message );
		location.href = '/';
	});
});