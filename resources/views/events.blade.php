@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Events</div>

    <div class="panel-body">
        @if($events->count() != 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Date</th>
                    <th>Teams</th>
                    <th>Judges</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td>{{$event->date}}</td>
                    <td><span class="badge">{{$event->teams->count()}}</span></td>
                    <td><span class="badge">{{$event->judges->count()}}</span></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{url('events/'.$event->id.'/teams')}}">TEAMS</a>
                        <a class="btn btn-primary btn-xs" href="{{url('events/'.$event->id.'/judges')}}">JUDGES</a>
                        <a class="btn btn-primary btn-xs" href="{{url('events/'.$event->id.'/rounds')}}">ROUNDS</a>
                        <a class="btn btn-success btn-xs" href="{{url('events/'.$event->id.'/scores')}}">SCORES</a>
                        <a class="btn btn-warning btn-xs" href="{{url('events/'.$event->id.'/edit')}}">EDIT</a>
                        <a class="btn btn-danger btn-xs" href="{{url('events/'.$event->id.'/delete')}}">DELETE</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h2>No Registered events!</h2>
        @endif
        <hr>
        <h3>Add event</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{url('events/create')}}">
        {{csrf_field    ()}}
                    <div class="form-group">
                <label for="name">Event Name:</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" name="date" id="date" required value="{{old('date')}}">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
@endsection
