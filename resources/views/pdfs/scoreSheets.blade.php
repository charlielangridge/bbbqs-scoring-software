<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Score Sheets</title>
	<meta name="description" content="">
	<style>
		.page-break {
			page-break-after: always;
		}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>
@foreach($teamResults as $team)
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>{{$event->name}} - {{$event->date}}</h3>
				<h1>{{$team->name}}</h1>
			</div>
			<div class="col-sm-12">
				<h2>Scores</h2>
				<table class="table table-striped">
					
					<thead>
						<th>Round</th>
						<th>Judge</th>
						<th>Appearance</th>
						<th>Texture / Tenderness</th>
						<th>Taste</th>
						<th>Weighted Score</th>
					</thead>
					<tbody>
					@foreach($team->scores as $score)
						<tr>
							<td>{{$score->scoreSheet->round->name}}</td>
							<td>{{$score->scoreSheet->judge->id}}</td>
							<td>{{$score->appearance}}</td>
							<td>{{$score->texture}}</td>
							<td>{{$score->taste}}</td>
							<td>{{$score->total}}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<h2>Notes</h2>
				<table class="table table-striped">
					<tbody>
					@foreach($team->notes as $note)
						<tr>
							<td>{{$note->round->name}}</td>
							<td>Judge #{{$note->judge->id}}</td>
							<td>{{$note->content}}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				

			</div>
			
		</div>
	</div>  
	<div class="page-break"></div>  
@endforeach
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
