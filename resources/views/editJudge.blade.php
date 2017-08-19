@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Edit judge - {{$judge->name}}</div>

    <div class="panel-body">
       
        <form method="POST" action="{{url('judges/'.$judge->id.'/update')}}">
        {{csrf_field()}}
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{$judge->name}}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required value="{{$judge->email}}">
            </div>
            <div class="form-group">
                <label for="phone">Phone number:</label>
                <input type="text" class="form-control" id="phone" name="phone" required value="{{$judge->phone}}">
            </div>
            <button type="submit" class="btn btn-default">Update Judge</button>
        </form>
    </div>
</div>
@endsection
