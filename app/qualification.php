<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Qualification
 * 
 * @property int $id
 * @property string $qualificationTitle
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Job[] $jobs
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class qualification extends Model
{
	protected $table = 'qualifications';

	protected $fillable = [
		'qualificationTitle'
	];

	public function jobs()
	{
		return $this->hasMany(job::class, 'qualification');
	}

	public function users()
	{
		return $this->hasMany(User::class, 'qualification');
	}
}
