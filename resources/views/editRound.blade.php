@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Edit Round - {{$round->name}}</div>

    <div class="panel-body">
       
        <form method="POST" action="{{url('rounds/'.$round->id.'/update')}}">
        {{csrf_field()}}
            <div class="form-group">
                <label for="name">Round Name:</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{$round->name}}">
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label><input id="main" name="main" type="checkbox" value='1' @if($round->main == 1) checked @endif>Main Round</label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label><input id="compulsory" name="compulsory" type="checkbox" value='1' @if($round->compulsory == 1) checked @endif>Compulsory</label>
                </div>
            </div>
           
            <button type="submit" class="btn btn-default">Update round</button>
        </form>
    </div>
</div>
@endsection
