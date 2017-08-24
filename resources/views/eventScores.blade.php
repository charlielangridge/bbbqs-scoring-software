@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Scores - {{$event->name}} ({{$event->date}})</div>

    <div class="panel-body">
        <h2>Results</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Overall</th>
                    @foreach($event->rounds as $round)
                    <th>{{$round->name}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @for ($i = 1; $i <= $event->teams->count(); $i++)
                <tr>
                    <td>{{$i}}</td>
                    <td>@if(isset($overallResults)){{$overallResults[$i]}}@endif</td>
                    @foreach($event->rounds as $round)
                    <td>{{$results[$round->id][$i]}}</td>
                    @endforeach
                    
                </tr>
            @endfor
            </tbody>
        </table>
        <p><a href="{{url('events/'.$event->id.'/addScorecard')}}">Add Scorecard</a></p>
        <p><a href="{{url('events/'.$event->id.'/judgeNotes')}}">Judge Notes</a></p>

        <h3>Scores Recored</h3>
        <ul>
            @foreach ($rounds as $round)
                <li @if($event->teams->count() * 6 == $recordedScores[$round->id]) style="color: green" @else style="color: red" @endif>{{$round->name}} - {{$event->teams->count() * 6}} Expected - {{$recordedScores[$round->id]}} Recorded</li>
            @endforeach
            <li>Notes Recorded: {{$event->judgeNotes->count()}}</li>
        </ul>
        <h4><a href="{{url('/events/'.$event->id.'/resultsSheets')}}" target="blank">Results Sheets</a></h4>
    </div>
</div>
@endsection
