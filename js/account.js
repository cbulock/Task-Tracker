$('#update_account').on('submit', function(event){
	event.preventDefault();
	TT.call('User/update', {
		id: $('#id').val(),
		pin: $('#pin').val()
	})
	.done(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
	});
});