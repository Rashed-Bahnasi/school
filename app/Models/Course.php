<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'courses';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];


    // Enum values for status
    public const STATUS = [
        'active'    => 'نشط',
        'inactive'  => 'متوقف',
        'completed' => 'مكتمل',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function organizer()
    {
        return $this->belongsTo(Employee::class);
    }
}
