@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Teams</div>

    <div class="panel-body">
        @if($teams->count() != 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Team Name</th>
                    <th>Pitmaster</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $team)
                <tr>
                    <td>{{$team->id}}</td>
                    <td>{{$team->name}}</td>
                    <td>{{$team->pitmasterName}}</td>
                    <td><a href="mailto::{{$team->email}}">{{$team->email}}</a></td>
                    <td>{{$team->phone}}</td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="{{url('teams/'.$team->id.'/edit')}}">EDIT</a>
                        <a class="btn btn-danger btn-xs" href="{{url('teams/'.$team->id.'/delete')}}">DELETE</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h2>No Registered Teams!</h2>
        @endif
        <hr>
        <h3>Add Team</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{url('teams/create')}}">
        {{csrf_field    ()}}
                    <div class="form-group">
                <label for="name">Team Name:</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="pitmasterName">Pitmaster name:</label>
                <input type="text" class="form-control" name="pitmasterName" id="pitmasterName" required value="{{old('pitmasterName')}}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="phone">Phone number:</label>
                <input type="text" class="form-control" id="phone" name="phone" required value="{{old('phone')}}">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
@endsection
