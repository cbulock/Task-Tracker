$('#add_chore').on('submit', function(event){
	event.preventDefault();
	TT.call('Chore/add', {
		name: $('#name').val(),
		desc: $('#desc').val(),
		priority: $('#priority').val(),
		repeat: $('#repeat').val()
	})
	.done(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#add_chore').trigger("reset");
	});
});