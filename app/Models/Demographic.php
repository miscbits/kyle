<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demographic extends Model
{
    public $table = "demographics";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        		'id',
		'first_name',
		'middle_name',
		'last_name',
		'email',
		'phone',
		'address',
		'twitter',
		'ward',
		'group',
		'student',
		'notes',

    ];

    public static $rules = [
        // create rules
    ];

    
	public function donations() {
		return $this->hasMany(App\Models\Donation::class);
	}

}
