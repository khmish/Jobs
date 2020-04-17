<?php

namespace App\Http\Controllers;

use App\jobUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class JobUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function applyForJab($jobID,$UserID)
    {
        # code...
        $jobUser=new jobUser;
        $jobUser->jobID=$jobID;
        $jobUser->UserID=$UserID;
        // return $jobUser;
        if($jobUser->save())
        {
           return redirect('/loginPage');
        }
        return response()->json('failed',400);


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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\jobUser  $jobUser
     * @return \Illuminate\Http\Response
     */
    public function show(jobUser $jobUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\jobUser  $jobUser
     * @return \Illuminate\Http\Response
     */
    public function edit(jobUser $jobUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\jobUser  $jobUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jobUser $jobUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\jobUser  $jobUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
        $jobUser=jobUser::where('jobID',$request->jobID)->where('UserID',$request->UserID);
        // return $jobUser;
        if($jobUser->delete())
        {
           return response()->json('deleted',200);
        }
        return response()->json('failed',400);
    }
}
