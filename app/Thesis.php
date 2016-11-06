<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    protected $dates = ['ends_at', 'created_at', 'updated_at'];
    protected $table = 'theses';

    public function proposal()
    {
        return $this->hasOne(Proposal::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

//    public function conselings()
//    {
//        return $this->hasMany(Conseling::class, 'theses_id');
//    }
}
