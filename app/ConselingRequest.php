<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConselingRequest extends Model
{
    use SoftDeletes;

    protected $table = 'conseling_requests';
    protected $dates = ['deleted_at'];


    public function conseling_schedule()
    {
        return $this->belongsTo(ConselingSchedule::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key', 'other_key');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
