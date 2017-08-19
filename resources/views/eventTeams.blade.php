@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Teams for a {{$event->name}} <span class="pull-right"><a href="{{url('events')}}">BACK TO EVENTS</a></span></div>

    <div class="panel-body">
       <h2>Attending Teams <span class="badge">{{$teams->count()}}</span></h2>
        <ul>
            @foreach($teams as $team)
            <li>{{$team->name}} - <a href="{{url('/events/'.$event->id.  '/teams/'.$team->id.'/remove')}}">Remove Team from Event</a></li>
            @endforeach
        </ul>
       <h3>Non-Attending Teams</h3>
       <ul>
           @foreach($nonAttendingTeams as $team)
           <li>{{$team->name}} - <a href="{{url('/events/'.$event->id.  '/teams/'.$team->id.'/add')}}">Add Team to Event</a></li>
           @endforeach
       </ul>
    </div>
</div>
@endsection
