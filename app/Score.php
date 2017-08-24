<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'scores';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['scoresheet_id','team_id','appearance','texture', 'taste'];
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
    public function scoresheet()
    {
        return $this->belongsTo('App\ScoreSheet')->orderBy('round_id');
    }

    public function team()
    {
        return $this->belongsTo('App\Team');
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
    public function getTotalAttribute($value)
    {
        return ($this->attributes['taste'] * 0.5 + $this->attributes['texture'] * 0.35 + $this->attributes['appearance'] * 0.15);
    }
}
