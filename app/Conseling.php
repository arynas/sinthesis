<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conseling extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thesis()
    {
        return $this->belongsTo(Thesis::class,'theses_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
