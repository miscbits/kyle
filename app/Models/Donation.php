<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $connection = "donation";

    public $table = "donations";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        'id',
		'amount',
		'contribution_timestamp',
		'demographic_id',

    ];

    public static $rules = [
        // create rules
    ];
}
