$('#edit_task').on('submit', function(event){
	event.preventDefault();
	TT.call('Task/edit', {
		id: $('#id').val(),
		name: $('#name').val(),
		desc: $('#desc').val(),
		priority: $('#priority').val(),
		repeat: $('#repeat_days').val()
	})
	.done(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
	});
});
