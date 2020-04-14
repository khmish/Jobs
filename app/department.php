<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * 
 * @property int $id
 * @property string $departmentName
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Job[] $jobs
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class department extends Model
{
	protected $table = 'departments';

	protected $fillable = [
		'departmentName'
	];

	public function jobs()
	{
		return $this->hasMany(job::class, 'department');
	}

	public function users()
	{
		return $this->hasMany(User::class, 'department');
	}
}