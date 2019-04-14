$('#edit_history').on('submit', function(event){
	event.preventDefault();
	TT.call('History/edit', {
		id: $('#id').val(),
		task: $('#task').val(),
		user: $('#user').val(),
		date: $('#date').val(),
		value: $('#value').val(),
	})
	.done(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
	});
});
