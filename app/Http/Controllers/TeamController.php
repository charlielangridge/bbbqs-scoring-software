<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'teams';
        $teams = Team::all();
        return view('teams', compact('page','teams'));
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
            'pitmasterName' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:11'
        ]);

        $team = new Team;
        $team->name = $request->name;
        $team->pitmasterName = $request->pitmasterName;
        $team->email = $request->email;
        $team->phone = $request->phone;
        $team->save();
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
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $page = 'teams';
        return view('editTeam', compact('page','team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'pitmasterName' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:11'
        ]);

        $team->name = $request->name;
        $team->pitmasterName = $request->pitmasterName;
        $team->email = $request->email;
        $team->phone = $request->phone;
        $team->save();
        return redirect()->route('teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return back();
    }
}
