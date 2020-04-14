<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Job
 * 
 * @property int $id
 * @property string $title
 * @property int $number
 * @property int $qualification
 * @property int $department
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class job extends Model
{
	protected $table = 'jobs';

	protected $casts = [
		'number' => 'int',
		'qualification' => 'int',
		'department' => 'int'
	];

	protected $fillable = [
		'title',
		'number',
		'qualification',
		'department'
	];

	public function department1()
	{
		return $this->belongsTo(department::class, 'department');
	}

	public function qualification1()
	{
		return $this->belongsTo(qualification::class, 'qualification');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'job_users', 'jobID', 'UserID')
					->withTimestamps();
	}
}
