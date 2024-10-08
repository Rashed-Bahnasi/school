<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'students';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [];
    // protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function setPreferredDaysAttribute($value)
    {
        $this->attributes['preferred_days'] = json_encode($value);
    }

    public function getPreferredDaysAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setPreferredTimesAttribute($value)
    {
        $this->attributes['preferred_times'] = json_encode($value);
    }

    public function setPreferredCoursesAttribute($value)
    {
        $this->attributes['preferred_courses'] = json_encode($value);
    }

    // لفك ترميز JSON عند الاسترجاع
    public function getPreferredTimesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getPreferredCoursesAttribute($value)
    {
        return json_decode($value, true);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
