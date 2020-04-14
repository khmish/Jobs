<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * 
 * @property int $id
 * @property string $cityName
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class city extends Model
{
	protected $table = 'cities';

	protected $fillable = [
		'cityName'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'city');
	}
}
