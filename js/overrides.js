$('#add_override').on('submit', function (event) {
	event.preventDefault();
	TT.call('History/addOverride', {
		user_id: $('#user').val(),
		points: $('input[name=method]:checked').val() === 'exempt'
			? $('#points').val() 
			: $('#points').val() * -1
	})
		.done(function () {
			$("html, body").animate({ scrollTop: 0 }, "slow");
		});
});
