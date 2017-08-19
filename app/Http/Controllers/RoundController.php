<?php

namespace App\Http\Controllers;

use App\Round;
use Illuminate\Http\Request;

class RoundController extends Controller
{
   public function index()
    {
        $page = 'rounds';
        $rounds = Round::orderBy('orderWeight')->get();
        return view('rounds', compact('page','rounds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:rounds|max:255',
        ]);

        $defaultWeight = Round::all()->count() + 1;

        $round = new Round;
        $round->name = $request->name;
        $round->compulsory = $request->compulsory;
        $round->main = $request->main;
        $round->orderWeight = $defaultWeight;
        $round->save();
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
    public function edit(Round $round)
    {
        $page = 'rounds';
        return view('editRound', compact('page','round'));        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Round $round)
    {
       $this->validate($request,[
            'name' => 'required|max:255',
        ]);
        $round->name = $request->name;
        $round->main = $request->main;
        $round->compulsory = $request->compulsory;
        $round->save();
        return redirect()->route('rounds');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(round $round)
    {
        $round->delete();
        return back();
    }

    public function orderUp(Round $round)
    {
        $swapRound = Round::where('orderWeight', $round->orderWeight-1)->first();
        $round->orderWeight = $round->orderWeight - 1;
        $swapRound->orderWeight = $swapRound->orderWeight + 1;
        $round->save();
        $swapRound->save();
        return back();
    }

    public function orderDown(Round $round)
    {
        $swapRound = Round::where('orderWeight', $round->orderWeight+1)->first();
        $round->orderWeight = $round->orderWeight + 1;
        $swapRound->orderWeight = $swapRound->orderWeight - 1;
        $round->save();
        $swapRound->save();
        return back();
    }
}
