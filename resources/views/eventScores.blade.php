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
                <tr>
                    <td>1</td>
                    <td>Team Name</td>
                    <td>Team Name</td>
                    <td>Team Name</td>
                    <td>Team Name</td>
                    <td>Team Name</td>
                </tr>
            </tbody>
        </table>
        <a href="{{url('events/'.$event->id.'/addScorecard')}}">Add Scorecard</a>
    </div>
</div>
@endsection
