<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'events';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name','date'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function teams()
    {
        return $this->belongsToMany('App\Team')->orderBy('name');
    }
    public function judges()
    {
        return $this->belongsToMany('App\Judge')->orderBy('name');
    }
    public function rounds()
    {
        return $this->belongsToMany('App\Round')->orderBy('orderWeight');
    }
    public function scoreSheets()
    {
        return $this->hasMany('App\ScoreSheet');
    }
    public function judgeNotes()
    {
        return $this->hasMany('App\JudgeNote');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
