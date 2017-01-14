var high = $('content a.task[data-importance="high"]').length;

if (high > 4) {
	$('content a.task[data-importance="low"]').hide();
}