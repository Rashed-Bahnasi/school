<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name', 'specialization', 'available_times', 'notes'];


    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }
    public function times()
    {
        return $this->hasMany(Time::class);
    }
}
