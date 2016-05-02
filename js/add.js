$('#add_task').on('submit', function(event){
	event.preventDefault();
	TT.call('Task/add', {
		name: $('#name').val(),
		desc: $('#desc').val(),
		priority: $('#priority').val(),
		repeat: $('#repeat').val()
	})
	.done(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#add_task').trigger("reset");
	});
});