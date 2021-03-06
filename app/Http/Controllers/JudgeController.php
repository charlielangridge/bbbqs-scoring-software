<?php

namespace App\Http\Controllers;

use App\Judge;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'judges';
        $judges = Judge::all();
        return view('judges', compact('page','judges'));
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
            'email' => 'required|email',
            'phone' => 'required|min:11'
        ]);

        $judge = new Judge;
        $judge->name = $request->name;
        $judge->email = $request->email;
        $judge->phone = $request->phone;
        $judge->save();
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
    public function edit(Judge $judge)
    {
        $page = 'judges';
        return view('editJudge', compact('page','judge'));        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Judge $judge)
    {
       $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:11'
        ]);

        $judge->name = $request->name;
        $judge->email = $request->email;
        $judge->phone = $request->phone;
        $judge->save();
        return redirect()->route('judges');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Judge $judge)
    {
        $judge->delete();
        return back();
    }
}
