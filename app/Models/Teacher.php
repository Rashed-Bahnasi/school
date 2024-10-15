<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'teachers';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = ['name', 'specialization_id', 'notes'];
    // protected $hidden = [];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function specializations()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }
    public function day(){
        return $this->hasMany(Day::class);
    }

    public function setAvailableTimesAttribute($value)
    {
        $this->attributes['available_times'] = json_encode($value);
    }

    public function getAvailableTimesAttribute($value)
    {
        return json_decode($value, true);
    }
}
