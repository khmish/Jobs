<?php
use App\User;
use App\job;
use App\city;
use App\department;
use App\qualification;
use App\jobUser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('welcome');
})->name('home');




//***************************************City ***************************** */
Route::get('/getCities', 'CityController@index');
Route::post('/addCity', 'CityController@store')->middleware('adminAuth');
Route::post('/updateCity', 'CityController@update')->middleware('adminAuth');

//***************************************Qualification ***************************** */
Route::get('/getQualification', 'QualificationController@index');
Route::post('/addQualification', 'QualificationController@store')->middleware('adminAuth');
Route::post('/updateQualification', 'QualificationController@update')->middleware('adminAuth');


//***************************************department ***************************** */
Route::get('/getDepartment', 'DepartmentController@index');
Route::post('/addDepartment', 'DepartmentController@store')->middleware('adminAuth');
Route::post('/updateDepartment', 'DepartmentController@update')->middleware('adminAuth');

//***************************************UserJobs ***************************** */


// login control **************************************
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');
Route::post('/register', 'UserController@register');
Route::get('/loginPage','UserController@loginPage')->name('loginPage');
Route::get('/registerPage', 'UserController@registerPage');


// User control **************************************
Route::get('/homeUser', 'UserController@homeUser')->name('homeUser')->middleware('auth');
Route::get('/getJobsForUser', 'UserController@getJobsForUser');
Route::post('/editUser', 'UserController@editUser')->name('editUser')->middleware('auth');
Route::get('/applyForJab/{jobID}/{UserID}', 'JobUserController@applyForJab')->name('applyForJab')->middleware('auth');


// Admin control **************************************
Route::get('/homeAdmin', 'UserController@homeAdmin')->name('homeAdmin')->middleware('adminAuth');
Route::get('/getAlljobs', 'JobController@index');
Route::post('/addJob', 'JobController@store')->middleware('adminAuth');
Route::post('/updateJob', 'JobController@update')->middleware('adminAuth');
Route::get('/showJob/{job}', 'JobController@show')->middleware('adminAuth');
Route::get('/showUser/{User}', 'UserController@show')->middleware('auth');
Route::post('/deleteApplicant', 'JobUserController@destroy')->middleware('adminAuth');
Route::get('/activateUser/{id}', 'UserController@activateUser')->middleware('adminAuth');
Route::get('/admin/{id}', 'UserController@admin')->middleware('adminAuth');

//--
Route::prefix('menu')->group(function () {
    
    Route::get('citiesPage', function(){
        $cities=city::all();
        return view('adminControl.cities')->with('cities',$cities);
    })->middleware('adminAuth');

    Route::get('departmentsPage', function(){
        $departments=department::all();
        return view('adminControl.departments')->with('departments',$departments);
    })->middleware('adminAuth');

    Route::get('qualificationsPage', function(){
        $qualifications=qualification::all();
        return view('adminControl.qualifications')->with('qualifications',$qualifications);

    })->middleware('adminAuth');

    Route::get('jobUserPage', function(){
        $jobUsers=jobUser::all();
        return view('adminControl.userJob')->with('jobUsers',$jobUsers);

    })->middleware('adminAuth');

    Route::get('usersPage', function(){
        $users=User::all();
        return view('adminControl.users')->with('users',$users);

    })->middleware('adminAuth');
});
