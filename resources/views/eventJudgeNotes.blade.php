@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Notes for {{$event->name}} <span class="pull-right"><a href="{{url('events')}}">BACK TO EVENTS</a></span></div>

    <div class="panel-body">
    @if($judgeNotes->count() != 0)
    	<table class="table table-striped">
    		<thead>
    			<th>Team</th>
    			<th>Round</th>
    			<th>Judge</th>
    			<th>Comments</th>
    			<th></th>
    		</thead>
    		<tbody>
    			@foreach($judgeNotes as $note)
    			<tr>
    				<td>{{$note->team->name}}</td>
    				<td>{{$note->round->name}}</td>
    				<td>{{$note->judge->name}}</td>
    				<td>{{$note->content}}</td>
    				<td><a href="{{url('events/'.$event->id.'/deleteComment/'.$note->id)}}" class="btn btn-xs btn-danger">Delete Comment</a></td>
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
    	{{ $judgeNotes->links() }}
	@endif

	<form action="{{url('events/'.$event->id.'/addJudgeNote')}}" method="POST">
	{{csrf_field()}}
		<h4>Add Note</h4>
		<div class="form-group">
			<label for="round_id">Select round:</label>
			<select class="form-control" id="round_id" name="round_id" required>
				@foreach($event->rounds as $round)
				<option value="{{$round->id}}">{{$round->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="judge_id">Select judge:</label>	
			<select class="form-control" id="judge_id" name="judge_id" required>
				@foreach($event->judges as $judge)
				<option value="{{$judge->id}}">{{$judge->id}} - {{$judge->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="team_id">Select team:</label>
			<select class="form-control" id="team_id" name="team_id" required>
				@foreach($event->teams as $team)
				<option value="{{$team->id}}">{{$team->id}} - {{$team->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="comment">Comment:</label>
			<textarea class="form-control" rows="3" id="comment"  name="comment" required></textarea>
		</div>
		<button type="submit" class="btn btn-default">Add Note</button>
	</form>
    </div>
</div>
@endsection
