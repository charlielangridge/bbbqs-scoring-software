@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Edit Event - {{$event->name}}</div>

    <div class="panel-body">
       
        <form method="POST" action="{{url('events/'.$event->id.'/update')}}">
        {{csrf_field()}}
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{$event->name}}">
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required value="{{$event->date}}">
            </div>
            <button type="submit" class="btn btn-default">Update event</button>
        </form>
    </div>
</div>
@endsection
