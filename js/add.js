$('#add_task').on('submit', function(event){
	event.preventDefault();
	var repeat = $('#repeat_days').val();
	if ($('#repeat_units').val() === 'month') {
		repeat = Math.round( $('#repeat_months').val() * 30.4 );
	}
	TT.call('Task/add', {
		name: $('#name').val(),
		desc: $('#desc').val(),
		priority: $('#priority').val(),
		value: $('#value').val(),
		repeat: repeat
	})
	.done(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#add_task').trigger("reset");
		$('#month_wrapper').hide();
		$('#day_wrapper').show().css('display','inline');
	});
});

$('#repeat_units').change(function(){
	if ($(this).val() === 'day') {
		$('#month_wrapper').hide();
		$('#day_wrapper').show().css('display','inline');
	}
	else {
		$('#day_wrapper').hide();
		$('#month_wrapper').show().css('display','inline');
	}
});
