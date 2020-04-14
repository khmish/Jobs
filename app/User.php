<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Tymon\JWTAuth\Contracts\JWTSubject;
/*implements JWTSubject*/
class User extends Authenticatable 
{
    use Notifiable;

    protected $table = 'users';

	protected $casts = [
		'Gender' => 'int',
		'city' => 'int',
		'qualification' => 'int',
		'department' => 'int',
		'active' => 'int'
	];

	protected $dates = [
		'email_verified_at',
		'birth'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'Gender',
		'birth',
		'city',
		'qualification',
		'department',
		'experienceYears',
		'address',
		'active',
		'remember_token'
	];

	public function city1()
	{
		return $this->belongsTo(city::class, 'city');
	}

	public function department1()
	{
		return $this->belongsTo(department::class, 'department');
	}

	public function qualification1()
	{
		return $this->belongsTo(qualification::class, 'qualification');
	}

	public function jobs()
	{
		return $this->belongsToMany(job::class, 'job_users', 'UserID', 'jobID')
					->withTimestamps();
	}

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }

    // // /**
    // //  * Return a key value array, containing any custom claims to be added to the JWT.
    // //  *
    // //  * @return array
    // //  */
    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }

    // public function setPasswordAttribute($password)
    // {
    //     if ( !empty($password) ) {
    //         $this->attributes['password'] = ($password);
    //     }
    // }   
}
