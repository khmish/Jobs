<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\job;
use App\jobUser;
use Carbon\Carbon;


class UserController extends Controller
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

    public function login(Request $request)
    {
       
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1])) {
            $user=Auth::user();
            
            if($user->admin==0){
                // return '1';
                return redirect('/homeUser');
            }
            // return '0';
            return redirect('/homeAdmin');
        }
        return 'error';
    }
    public function logout()
    {
       
        
        Auth::logout();
        return redirect('/loginPage');
    }
    public function loginPage()
    {
        $user=Auth::user();
        if(Auth::check()){

            if($user->admin==0){
                return redirect('/homeUser');
            }
            else if($user->admin==1) {
                return redirect('/homeAdmin');
                # code...
            }
        }
        
        return view('loginControl.login');
    }
    public function registerPage()
    {
        return view('loginControl.register');
    }
    public function homeUser()
    {
        # code...
        $user=Auth::user();
        $jobs=job::where('qualification',$user->qualification)->where('department',$user->department)->get();
        
        return view('userPages.home')->with('jobs',$jobs);
    }
    public function getJobsForUser()
    {
        # code...
        $user=Auth::user();
        $userJobs=jobUser::where('UserID',$user->id)->get();
        return $userJobs;
    }
    
    public function homeAdmin()
    {
        # code...
        $jobs=job::paginate(15);
        return view('adminControl.home')->with('jobs',$jobs);
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
     public function register(Request $request)
    {
        $imgs='';
        if ($request->hasFile('pic')) {
            
            $imgs = $request->file('pic')->store(
                'avatar', 'public'
            );
            
             
        }
        $user = new User;
        $user->pic=$imgs;
        $user->email    = $request->email;
        $user->name = $request->name;
        $user->birth = $request->birth;
        $user->Gender=$request->Gender;
        $user->city=$request->city;
        $user->qualification=$request->qualification;
        $user->department=$request->department;
        $user->experienceYears=$request->experienceYears;
        $user->address=$request->address;
        $user->password = bcrypt($request->password);
        if($user->save())
        {
            return view('loginControl.login');
        }
        return view('loginControl.login');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //resources/views/userPages/userInfo.blade.php
        $user=User::find($id);
        return view('userPages.userInfo')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
    }
    public function editUser(Request $request)
    {
       
        $imgs='';
        if ($request->hasFile('pic')) {
            
            $imgs = $request->file('pic')->store(
                'avatar', 'public'
            );
            
             
        }
        $user = User::find($request->id);
        
        $request->password?$user->password = bcrypt($request->password):$user->password;
        $request->name?$user->name = $request->name:$user->name;
        $request->birth?$user->birth = $request->birth:$user->birth;
        $request->qualification?$user->qualification=$request->qualification:$user->qualification;
        $request->department?$user->department=$request->department:$user->department;
        $request->city?$user->city=$request->city:$user->city;
        $request->experienceYears?$user->experienceYears=$request->experienceYears:$user->experienceYears;
        $request->address?$user->address=$request->address:$user->address;
        $request->Gender?$user->Gender=$request->Gender:$user->Gender;
        $imgs?$user->pic=$imgs:$user->pic;
        

        if($user->save())
        {
            // return $user;
            return redirect('/loginPage');
        }
        return 'error';
    }

    public function activateUser($id)
    {
        # code...
        $user = User::find($id);
        $user->active=($user->active==1)?0:1;
        if($user->save())
        {
            return response()->json('success',200);
        }
        return response()->json('fail',400);

    }
    public function admin($id)
    {
        # code...
        $user = User::find($id);
        $user->admin=1;
        if($user->save())
        {
            return response()->json('success',200);
        }
        return response()->json('fail',400);

    }

    public function onHoldUsers()
    {
        # code...
        $users = User::where('active',0)->get();
        
        $bUser =array();
        foreach ($users as $user) {
            # code...
            $bUser[] =[
            'id' =>$user->id,
            'name'=>$user->name,
            'Gender'=>$user->Gender,
            'city'=>$user->city1->cityName,
            'qualification'=>$user->qualification1->qualificationTitle,
            'department'=>$user->department1->departmentName,
            'birth'=>Carbon::parse($user->birth)->age
            ];
        }
        return response()->json($bUser,200);

    }
    public function getUserByName(Request $request)
    {
        $users = User::where('name','like',$request->name)->get();
        $bUser =array();
        foreach ($users as $user) {
            # code...
            $bUser[] =[
            'id' =>$user->id,
            'name'=>$user->name,
            'Gender'=>$user->Gender,
            'city'=>$user->city1->cityName,
            'qualification'=>$user->qualification1->qualificationTitle,
            'department'=>$user->department1->departmentName,
            'birth'=>Carbon::parse($user->birth)->age
            ];
        }
        
            
        
        return response()->json($bUser,200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
