<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public $timestamps = false;

    public function getRegtimeAttribute($attr) {        
        if($attr) {
            return Carbon::parse($attr)->timezone(config('app.timezone'))->format('Y-m-d H:i');
        }
        else
            return null;
    }
}
