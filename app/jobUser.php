<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobUser
 * 
 * @property int $jobID
 * @property int $UserID
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Job $job
 * @property User $user
 *
 * @package App\Models
 */
class jobUser extends Model
{
	protected $table = 'job_users';
	public $incrementing = false;

	protected $casts = [
		'jobID' => 'int',
		'UserID' => 'int'
	];

	public function job()
	{
		return $this->belongsTo(job::class, 'jobID');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'UserID');
	}
}
