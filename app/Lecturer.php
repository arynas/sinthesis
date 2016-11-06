<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function theses()
    {
        return $this->hasMany(Thesis::class);
    }

//    public function conseling_schedules()
//    {
//        return $this->hasMany(Conseling_Schedule::class);
//    }
}
