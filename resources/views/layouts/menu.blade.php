
<div class="list-group">
    <a href="{{url('home')}}" class="list-group-item @if($page=="home") active @endif">Home</a>
    <a href="{{url('teams')}}" class="list-group-item @if($page=="teams") active @endif">Teams</a>
    <a href="{{url('judges')}}" class="list-group-item @if($page=="judges") active @endif">Judges</a>
    <a href="{{url('events')}}" class="list-group-item @if($page=="events") active @endif">Events</a>
    <a href="{{url('rounds')}}" class="list-group-item @if($page=="rounds") active @endif">Rounds</a>
</div>
