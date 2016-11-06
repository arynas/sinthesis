<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConselingSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'conseling_schedules';
    protected $dates = ['deleted_at','starts_at'];
    protected static function boot() {
        parent::boot();

        static::deleting(function($conseling_schedule) {
            $conseling_schedule->conseling_requests()->delete();
        });
    }


    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function conseling_requests()
    {
        return $this->hasMany(ConselingRequest::class, 'conseling_schedule_id');
    }
}
