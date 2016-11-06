<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function thesis()
    {
        return $this->belongsTo(Thesis::class,'theses_id');
    }
}
