<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function proposal()
    {
        return $this->hasOne(Proposal::class);
    }

    public function thesis()
    {
        return $this->hasOne(Thesis::class);
    }

    public function conseling_requests()
    {
        return $this->hasMany(ConselingRequest::class);
    }
}
