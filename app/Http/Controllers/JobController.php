<?php

namespace App\Http\Controllers;

use App\job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jobs=job::paginate(15);
        return $jobs;
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
        $job=new job;
        $job->title=$request->title;
        $job->number=$request->number;
        $job->qualification=$request->qualification;
        $job->department=$request->department;
        if($job->save())
        {
            return response()->json('added',200);
        }
        return response()->json('error',400);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(job $job)
    {
        //
        $job=job::find($job->id);
        return $job;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $job=job::find($request->id);
        $job->title=$request->title;
        $job->number=$request->number;
        $job->qualification=$request->qualification;
        $job->department=$request->department;
        if($job->save())
        {
            return response()->json('saved',200);
        }
        return response()->json('error',400);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(job $job)
    {
        //
    }
}
