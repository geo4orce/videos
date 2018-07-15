<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    public function videos()
    {
        // this is not used by this app yet
        return $this->belongsToMany('App\Video');
    }
}
