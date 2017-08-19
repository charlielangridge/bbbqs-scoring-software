@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Add Scorecard - {{$event->name}} ({{$event->date}}) <span class="pull-right"><a href="{{url('events/'.$event->id.'/scores')}}">BACK TO SCORES</a></span></div>

    <div class="panel-body">
        <form method="POST" action="{{url('events/'.$event->id.'/addScore')}}">
        {{csrf_field()}}
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="judge_id">Judge</label>
                        <select class="form-control" id="judge_id" required name="judge_id">
                            <option></option>
                            @foreach($event->judges as $judge)
                            <option value="{{$judge->id}}">{{$judge->id}} ({{$judge->name}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="table">Table</label>
                        <input type="number" class="form-control" id="table" name="table" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="round_id">Rounds</label>
                        <select class="form-control" id="round_id" required name="round_id">
                            <option></option>
                            @foreach($event->rounds as $round)
                            <option value="{{$round->id}}">{{$round->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>Team</th>
                    <th>Appearance</th>
                    <th>Texture</th>
                    <th>Taste</th>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 6; $i++)
                    <tr>
                        <td><input type="number" name="team[{{$i}}]" required min="0" max="10"></td>
                        <td><input type="number" name="appearance[{{$i}}]" required min="0" max="10"></td>
                        <td><input type="number" name="texture[{{$i}}]" required min="0" max="10"></td>
                        <td><input type="number" name="taste[{{$i}}]" required min="0" max="10"></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
            <button type="submit" class="btn btn-default">Submit Score</button>

        </form>
    </div>
</div>
@endsection
