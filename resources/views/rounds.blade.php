@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Rounds</div>

    <div class="panel-body">
        @if($rounds->count() != 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Compulsory</th>
                    <th>Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($rounds as $round)
                <tr>
                    <td>{{$round->name}}</td>
                    <td>@if ($round->compulsory == 1) YES @else NO @endif</td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="{{url('rounds/'.$round->id.'/edit')}}">EDIT</a>
                        <a class="btn btn-danger btn-xs" href="{{url('rounds/'.$round->id.'/delete')}}">DELETE</a>
                    </td>
                    <td>
                        @if($round->orderWeight > 1)<a href="{{url('rounds/'.$round->id.'/orderUp')}}"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>@endif
                        @if($round->orderWeight < App\Round::all()->count())<a href="{{url('rounds/'.$round->id.'/orderDown')}}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>@endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h2>No Registered rounds!</h2>
        @endif
        <hr>
        <h3>Add round</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{url('rounds/create')}}">
        {{csrf_field    ()}}
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{old('name')}}">
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label><input id="main" name="main" type="checkbox" value='1'>Main Round</label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label><input id="compulsory" name="compulsory" type="checkbox" value="1">Compulsory</label>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
@endsection
