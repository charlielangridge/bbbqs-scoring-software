@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Edit Team - {{$team->name}}</div>

    <div class="panel-body">
       
        <form method="POST" action="{{url('teams/'.$team->id.'/update')}}">
        {{csrf_field()}}
            <div class="form-group">
                <label for="name">Team Name:</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{$team->name}}">
            </div>
            <div class="form-group">
                <label for="pitmasterName">Pitmaster name:</label>
                <input type="text" class="form-control" name="pitmasterName" id="pitmasterName" required value="{{$team->pitmasterName}}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required value="{{$team->email}}">
            </div>
            <div class="form-group">
                <label for="phone">Phone number:</label>
                <input type="text" class="form-control" id="phone" name="phone" required value="{{$team->phone}}">
            </div>
            <button type="submit" class="btn btn-default">Update Team</button>
        </form>
    </div>
</div>
@endsection
