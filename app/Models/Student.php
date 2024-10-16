<?php

namespace App\Models;

use App\Models\Country;
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


    // Enum values for status
    public const STATUS = [
        'active'    => 'نشط',
        'inactive'  => 'متوقف',
        'potential' => 'محتمل',
        'withdrawn' => 'منسحب',
    ];


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
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function day()
    {
        return $this->hasMany(Day::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student');
    }



    public function setPerfectTimesAttribute($value)
    {
        $this->attributes['perfect_times'] = json_encode($value);
    }

    public function getPerfectTimesAttribute($value)
    {
        return json_decode($value, true);
    }
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
