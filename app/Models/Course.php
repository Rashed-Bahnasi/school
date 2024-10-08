<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
