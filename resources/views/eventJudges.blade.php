@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Judges for a {{$event->name}} <span class="pull-right"><a href="{{url('events')}}">BACK TO EVENTS</a></span></div>

    <div class="panel-body">
       <h2>Attending Jduges <span class="badge">{{$judges->count()}}</span></h2>
        <ul>
            @foreach($judges as $judge)
            <li>{{$judge->name}} - <a href="{{url('/events/'.$event->id.  '/judges/'.$judge->id.'/remove')}}">Remove Judge from Event</a></li>
            @endforeach
        </ul>
       <h3>Non-Attending judges</h3>
       <ul>
           @foreach($nonAttendingJudges as $judge)
           <li>{{$judge->name}} - <a href="{{url('/events/'.$event->id.  '/judges/'.$judge->id.'/add')}}">Add Judge to Event</a></li>
           @endforeach
       </ul>
    </div>
</div>
@endsection
