<?php

namespace App\Http\Controllers;

use App\Event;
use App\Judge;
use App\Round;
use App\Score;
use App\ScoreSheet;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$page = 'events';
        $events = Event::all();
        return view('events', compact('page','events'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $this->validate($request,[
            'name' => 'required|unique:teams|max:255',
            'date' => 'required|date'
        ]);

        $event = new Event;
        $event->name = $request->name;
        $event->date = $request->date;
        $event->save();
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $page = 'events';
        return view('editEvent', compact('page','event'));        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
       $this->validate($request,[
            'name' => 'required|max:255',
            'date' => 'required|date',
        ]);

        $event->name = $request->name;
        $event->date = $request->date;
        $event->save();
        return redirect()->route('events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(event $event)
    {
        $event->delete();
        return back();
    }

    public function teams(Event $event)
    {
        $page = 'events';
        $teams = $event->teams;
        $nonAttendingTeams = Team::whereDoesntHave('events', function ($query) use ($event) {
            $query->where('id', $event->id);
        })->orderBy('name')->get();

        return view('eventTeams', compact('page','event','teams', 'nonAttendingTeams'));
    }

    public function addTeam(Event $event, Team $team)
    {
        $event->teams()->attach($team);
        return back();
    }
    public function removeTeam(Event $event, Team $team)
    {
        $event->teams()->detach($team);
        return back();
    }

    public function judges(Event $event)
    {
        $page = 'events';
        $judges = $event->judges;
        $nonAttendingJudges = Judge::whereDoesntHave('events', function ($query) use ($event) {
            $query->where('id', $event->id);
        })->orderBy('name')->get();

        return view('eventJudges', compact('page','event','judges', 'nonAttendingJudges'));
    }

    public function addJudge(Event $event, Judge $judge)
    {
        $event->judges()->attach($judge);
        return back();
    }
    public function removeJudge(Event $event, Judge $judge)
    {
        $event->judges()->detach($judge);
        return back();
    }

    public function rounds(Event $event)
    {
        $page = 'events';
        $rounds = $event->rounds;
        $nonRounds = Round::whereDoesntHave('events', function ($query) use ($event) {
            $query->where('id', $event->id);
        })->orderBy('name')->get();

        return view('eventRounds', compact('page','event','rounds', 'nonRounds'));
    }

    public function addRound(Event $event, Round $round)
    {
        $event->rounds()->attach($round);
        return back();
    }
    public function removeRound(Event $event, Round $round)
    {
        $event->rounds()->detach($round);
        return back();
    }


    public function scores(Event $event)
    {
        $page = 'events';
        $rounds = Round::orderBy('orderWeight')->get();
        $eventScores = Score::whereHas('scoresheet', function ($query) use ($event) {
                    $query->where('event_id', $event->id);
                })->get();

        $roundScores = [];

        foreach ($eventScores as $eventScore) {
            if (!isset($roundScores[$eventScore->scoreSheet->round_id]))
            {
                $roundScores[$eventScore->scoreSheet->round_id] = 1;
            }
            else
            {
                $roundScores[$eventScore->scoreSheet->round_id]++;
            }
        }
        foreach ($rounds as $round) {
            if(!isset($roundScores[$round->id]))
            {
                $roundScores[$round->id] = 0;
            }
        }
        $recordedScores = $roundScores;
        $teams = $event->teams;
        
        $results = [];
        $GCCheck = [];
        $teamTotals = [];
        foreach ($event->rounds as $round) {
            // are all the scores in?
            if ($event->teams->count() * 6 === $roundScores[$round->id])
            {
                $GCCheck[$round->id] = 1;
                $roundScores = Score::
                    whereHas('scoresheet', function ($query) use ($event) {
                        $query->where('event_id', $event->id);
                    })
                    ->whereHas('scoresheet', function ($query) use ($round) {
                        $query->where('round_id', $round->id);
                    })
                    ->get();

                foreach ($event->teams as $team) {
                    $teamScores[$team->id] = [];
                }
                ksort($teamScores);
                foreach ($roundScores as $score) {
                    array_push($teamScores[$score->team_id], $score->total);
                }
                foreach ($event->teams as $team) {
                    asort($teamScores[$team->id]);
                    array_shift($teamScores[$team->id]);
                    $teamScores[$team->id] = array_sum($teamScores[$team->id]) * 2;
                }
                arsort($teamScores);
                reset($teamScores);
                $i = 1;
                foreach ($teamScores as $team_id => $teamScore) {
                    $team = Team::find($team_id);
                    $results[$round->id][$i] = "$team->name ($teamScore)";
                    $i++;
                   
                    if (isset($teamTotals[$team->id]))
                    {
                        $teamTotals[$team->id] += $teamScore;
                    }
                    else
                    {
                        $teamTotals[$team->id] = $teamScore;
                    }

                }

            }
            else
            {
                $GCCheck[$round->id] = 0;
                for ($i=1; $i <= $teams->count() ; $i++) { 
                    $results[$round->id][$i] = NULL;
                }
            }

        }

        // Are all scores completed for the big 4?
        if($GCCheck[1]+$GCCheck[2]+$GCCheck[3]+$GCCheck[4] == 4)
        {
            arsort($teamTotals);
            reset($teamTotals);
            $i = 1;
            foreach ($teamTotals as $team_id => $teamTotal) {
                $team = Team::find($team_id);
                $overallResults[$i] = "$team->name ($teamTotal)";
                $i++;
            }
        }
        else
        {
            for ($i=1; $i <= $event->teams->count() ; $i++) { 
                $overallResults[$i] = null;
            }
        }


        return view('eventScores', compact('event', 'page', 'rounds', 'roundScores', 'recordedScores','results', 'overallResults'));
    }

    public function addScorecard(Event $event)
    {
        $page = 'events';
        return view('eventAddScorecard', compact('event','page'));
    }

    public function addScore(Event $event, Request $request)
    {
        // Check teams are unique
        if (count($request->team) !== count(array_unique($request->team)))
        {
            \Alert::danger('Duplicate Teams!')->flash();

            return back();
        }

        DB::beginTransaction();
        // check to see if a scoresheet is already in place for this event / round / judge
        if(Scoresheet::where('event_id', $event->id)->where('judge_id', $request->judge_id)->where('round_id',$request->round_id)->count() > 0)
        {
            \Alert::danger('Score Sheet already logged for event->round->judge!')->flash();
            DB::rollBack();
            return back(); 
        }


        $scoreSheet = new ScoreSheet;
        $scoreSheet->event_id = $event->id;
        $scoreSheet->judge_id = $request->judge_id;
        $scoreSheet->round_id = $request->round_id;
        $scoreSheet->table = $request->table;
        $scoreSheet->save();


        for ($i=1; $i <= 6; $i++) { 
            // Check team doesn't already have a score for this event for this judge for this round

            if(
            Score::where('team_id', $request->team[$i])
                ->whereHas('scoresheet', function ($query) use ($scoreSheet) {
                    $query->where('judge_id', $scoreSheet->judge_id);
                })
                ->whereHas('scoresheet', function ($query) use ($scoreSheet) {
                    $query->where('round_id', $scoreSheet->round_id);
                })
                ->count() > 0
            )
            {
               \Alert::danger('Score already logged for event->team->round->judge!')->flash();
                DB::rollBack();
                return back();   
            }

            $score = new Score;
            $score->scoresheet_id = $scoreSheet->id;
            $score->team_id = $request->team[$i];
            $score->appearance = $request->appearance[$i];
            $score->texture = $request->texture[$i];
            $score->taste = $request->taste[$i];
            $score->save();
        }

        DB::commit();
        $page = 'events';
        $rounds = Round::orderBy('orderWeight')->get();
        return view('eventScores', compact('event', 'page', 'rounds'));

    }
}
