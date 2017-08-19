@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Rounds for a {{$event->name}} <span class="pull-right"><a href="{{url('events')}}">BACK TO EVENTS</a></span></div>

    <div class="panel-body">
       <h2>Rounds <span class="badge">{{$rounds->count()}}</span></h2>
        <ul>
            @foreach($rounds as $round)
            <li>{{$round->name}} - <a href="{{url('/events/'.$event->id.  '/rounds/'.$round->id.'/remove')}}">Remove round from Event</a></li>
            @endforeach
        </ul>
       <h3>Non Rounds</h3>
       <ul>
           @foreach($nonRounds as $round)
           <li>{{$round->name}} - <a href="{{url('/events/'.$event->id.  '/rounds/'.$round->id.'/add')}}">Add round to Event</a></li>
           @endforeach
       </ul>
    </div>
</div>
@endsection
