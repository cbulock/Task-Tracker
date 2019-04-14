var labels = [];
var chartdata = [];

TT.call('History/by_task', {task: task_id})
.done(function(result) {
	$.each(result.users, function(index, user) {
		labels.push(user.username);
		chartdata.push(user.count);
	});

	var data = {
		labels: labels,
		datasets: [
			{
				data: chartdata,
				backgroundColor: [
					"#FF6384",
					"#36A2EB"
				],
				hoverBackgroundColor: [
					"#FF305B",
					"#137BC1"
				]
			}
		]
	};

	var chart = new Chart( $("#chart"), {
		type: 'pie',
		data: data,
		options: {
			responsive: true,
			legend: {
				labels: {
					fontColor: 'white'
				},
			}
		}
	});
});


