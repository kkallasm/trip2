<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follows';

    protected $fillable = ['followable_id', 'followable_type'];

    //public bool $timestamps = false;

    public function usesTimestamps()
    {
        return false;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function followable()
    {
        return $this->morphTo();
    }
}
