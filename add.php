<!DOCTYPE html>
<html>

	<head>
		<title>Add Chore</title>
		<meta name="viewport" content="width=device-width, initial-scale=0.75, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.0/css/bootstrap-slider.min.css" crossorigin="anonymous">
		<link rel="stylesheet" href="css/add.css">

		<link rel='shortcut icon' type='image/png' href='/img/32.png' />
		<link rel="apple-touch-icon" href="/img/60.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="/img/76.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="/img/120.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="/img/152.png" />
		<link rel="apple-touch-icon" sizes="180x180" href="/img/180.png" />
		<link rel="icon" sizes="192x192" href="/img/192.png" />
	</head>

	<body>

		<form action='add_chore.php' method='post'>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Chore Name">
			</div>
			<div class="form-group">
				<label for="desc">Description</label>
				<textarea class="form-control" id="desc" name="desc" placeholder="Chore description"></textarea>
			</div>
			<div class="form-group">
				<label for="repeat">Repeat After</label>
				<input
						type="text"
						id="repeat"
						name="repeat"
						data-provide="slider"
						data-slider-ticks="[1, 7, 14, 21, 30]"
						data-slider-tooltip="always"
						data-slider-step="1"
						data-slider-value="7"
						data-slider-max="30"
				>
				<p class="help-block">After how many days should this chore be available to complete again?</p>
			</div>
			<div class="form-group">
				<label for="priority">Priority</label>
				<input
						type="text"
						id="priority"
						name="priority"
						data-provide="slider"
						data-slider-ticks-labels='["low", "high"]'
						data-slider-step="1"
						data-slider-value="3"
				>
			</div>
			<button type="submit" class="btn btn-primary">Add Chore</button>
		</form>
		<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.0/bootstrap-slider.min.js"></script>
	</body>

</html>