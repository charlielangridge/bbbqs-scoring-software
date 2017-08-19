@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Judges</div>

    <div class="panel-body">
        @if($judges->count() != 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($judges as $judge)
                <tr>
                    <td>{{$judge->name}}</td>
                    <td><a href="mailto::{{$judge->email}}">{{$judge->email}}</a></td>
                    <td>{{$judge->phone}}</td>
                    <td>
                        <a class="btn btn-warning btn-xs" href="{{url('judges/'.$judge->id.'/edit')}}">EDIT</a>
                        <a class="btn btn-danger btn-xs" href="{{url('judges/'.$judge->id.'/delete')}}">DELETE</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h2>No Registered Judges!</h2>
        @endif
        <hr>
        <h3>Add Judge</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{url('judges/create')}}">
        {{csrf_field    ()}}
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{old('name')}}">
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
