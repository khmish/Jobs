<?php

namespace App\Http\Controllers;

use App\qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $qualification=qualification::all();

        return $qualification;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $qualification=new qualification;
        $qualification->qualificationTitle=$request->qualificationTitle;
        if($qualification->save())
        {
            return response()->json('added',200);
        }
        return response()->json('error',400);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function show(qualification $qualification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function edit(qualification $qualification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $qualification=qualification::find($request->id);
        $qualification->qualificationTitle=$request->qualificationTitle;
        if($qualification->save())
        {
            return response()->json('saved',200);
        }
        return response()->json('error',400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(qualification $qualification)
    {
        //
    }
}
