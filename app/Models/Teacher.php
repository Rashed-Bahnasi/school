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

    protected $casts = [
        'available_times' => 'array',
    ];


    // علاقة مع جدول الدورات
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
